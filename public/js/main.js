import { determinePartiesSide, generateParties, Party } from "./parties.js";
import { generateRounds } from "./rounds.js";

(function main() {
    const $range = document.getElementById("range");
    const $value = document.getElementById("value");
    const $chart = document.getElementById("chart");
    const url = new URL(location.href);
    const players = url.searchParams.get("players");
    const $options = document.getElementsByClassName("options");
    const $parties = document.getElementById("parties");
    const flip = {
        "#slider": "upload",
        "#upload": "slider",
    };

    const validate = (num) =>
        num >= Number($range.min) && num <= Number($range.max);

    if (players !== null && validate(players)) {
        $range.value = players;
    }

    for (const $btn of $options) {
        $btn.addEventListener("click", (e) => {
            const target = e.target.getAttribute("data-target");
            const $target = document.querySelector(target);
            const $hint = document.querySelector(`${target}-hint`);

            if ($target.getAttribute("aria-hidden") === "true") {
                $target.ariaHidden = false;
                $hint.ariaHidden = false;
                document.getElementById(flip[target]).ariaHidden = true;
                document.getElementById(
                    `${flip[target]}-hint`
                ).ariaHidden = true;
            }
        });
    }

    $parties.addEventListener("change", (e) => {
        const reader = new FileReader();

        reader.onload = (ev) => {
            let parties = parseCsv(ev.target.result);

            if (
                !validate(parties.length) ||
                !parties.every((p) => "name" in p && "continent" in p)
            ) {
                // eslint-disable-next-line no-alert
                return alert("Invalid party data");
            }

            parties = parties.map((party) => {
                return new Party(party.name, party.order, party.continent);
            });

            url.searchParams.delete("players");
            history.pushState({}, null, url);

            render($chart, determinePartiesSide(parties));
        };

        reader.readAsText(e.target.files[0]);
    });

    $range.addEventListener("change", (e) => {
        if (
            e.target.value === $value.textContent ||
            !validate(Number(e.target.value))
        ) {
            e.preventDefault();
            return;
        }

        url.searchParams.set("players", e.target.value);
        history.pushState({}, null, url);

        render($chart, generateParties(($value.textContent = e.target.value)));
    });

    document.addEventListener("keyup", (e) => {
        if (e.key === "ArrowRight") {
            $range.value = Number($range.value) + 1;
            $range.dispatchEvent(new Event("change"));
        }

        if (e.key === "ArrowLeft") {
            $range.value = Number($range.value) - 1;
            $range.dispatchEvent(new Event("change"));
        }
    });

    render($chart, generateParties(($value.textContent = $range.value)));
})();

/**
 * Simple CSV parser
 *
 * @param {string} csv
 */
function parseCsv(csv) {
    const returns = [];
    const heading = [];

    return csv.split("\n").reduce((returns, line, i) => {
        if (line === "") {
            return returns;
        }

        const columns = line.split(",").map((col) => col.trim());

        if (i === 0) {
            heading.push(...columns);
            return returns;
        }

        const obj = {
            order: i,
        };

        columns.forEach((col, i) => {
            obj[heading[i]] = /^\d$/.test(col) ? Number(col) : col;
        });

        returns.push(obj);

        return returns;
    }, returns);
}

/**
 * @param {HTMLDivElement} $chart
 * @param {import('./parties.js').Party[]} parties
 */
function render($chart, parties) {
    const rounds = generateRounds(parties);

    $chart.innerHTML = "";
    $chart.style.setProperty("--participants", `${parties.length}`);

    for (const roundId in rounds) {
        const round = rounds[roundId];

        const $round = document.createElement("section");
        const $title = document.createElement("h3");
        const $matches = document.createElement("div");

        $round.id = `round-${roundId}`;
        $title.id = `${$round.id}-title`;
        $title.textContent = `Round ${roundId}`;

        $round.setAttribute("aria-labelledby", $title.id);
        $round.classList.add("rounds");
        $round.style.setProperty("--curr-round", roundId);

        $matches.classList.add("matches");
        $matches.style.setProperty("--grid", round.matches.length);

        $round.append($title);

        for (const match of round.matches) {
            const $match = document.createElement("div");

            $match.classList.add("match");

            if (match.hidden) {
                $match.ariaHidden = true;
                $matches.append($match);

                continue;
            }

            $match.style.setProperty("--size", match.size);
            $match.style.setProperty("--span", match.span || 0);

            match.next.round &&
                $match.style.setProperty("--next-round", match.next.round);
            match.next.side &&
                $match.setAttribute("data-next-side", match.next.side);

            if (match.size > 1 && match.size % 2 > 0) {
                $match.classList.add("odd");
            }

            if (round.id > 1) {
                $match.classList.add("has-prev");
            }

            if (round.id === rounds.length) {
                $match.classList.add("final-round");
            }

            $match.id = `round-${roundId}-match-${match.id}`;
            $match.setAttribute("data-match", match.id);

            const $matchTitle = document.createElement("h4");
            const $matchInner = document.createElement("div");

            $matchTitle.id = `${$match.id}-title`;
            $matchInner.id = `${$match.id}-inner`;

            $matchTitle.textContent = match.id;
            $matchTitle.ariaLabel = `Round ${round.id} Match ${match.id}`;
            $matchTitle.ariaDescription = `${$matchTitle.ariaLabel} of ${match.label}`;
            $matchTitle.classList.add("match-title");

            $matchInner.role = "radiogroup";
            $matchInner.ariaLabel = match.label;
            $matchInner.classList.add("match-inner");

            $match.setAttribute("aria-labelledby", $matchTitle.id);
            $match.setAttribute("aria-describedby", $match.id);
            $match.append($matchTitle);

            for (const party of match.parties) {
                const $participant = document.createElement("label");
                const $label = document.createElement("div");
                const $name = document.createElement("span");
                const $continent = document.createElement("span");
                const $check = document.createElement("input");

                $participant.id = `${$match.id}-${party.side}`;
                $participant.title = party.name;

                $name.id = `${$participant.id}-name`;
                $name.textContent = $name.ariaLabel = party.name;
                $name.classList.add("party-name");

                $continent.id = `${$participant.id}-continent`;
                $continent.textContent = $continent.ariaLabel =
                    party.continent || "...";
                $continent.classList.add("party-continent");

                $check.type = "radio";
                $check.name = $matchInner.id;
                $check.id = `${$participant.id}-check`;
                $check.value = party.id;

                if (round.id > 1) {
                    $check.disabled = true;
                }

                $label.append($name, $continent);
                $label.classList.add("party-label");

                $check.classList.add("party-check");
                $check.setAttribute("aria-describedby", $match.id);
                $check.addEventListener("change", (e) => {
                    const partyId = Number(e.target.value);
                    const winner = match.parties.find(
                        (party) => party.id === partyId
                    );

                    winnerSelected(e.target, match, winner, rounds);
                });

                if (party.match.id) {
                    const originMatch = `round-${party.match.round}-match-${party.match.id}`;

                    $participant.setAttribute("data-origin", originMatch);
                }

                $participant.htmlFor = $check.id;
                $participant.ariaLabel = party.label;
                $participant.classList.add("party");
                $participant.setAttribute("data-side", party.side);
                $participant.addEventListener("assign-winner", (e) => {
                    const winner = e.detail;

                    $check.value = party.id = winner.id;
                    $name.textContent = party.name = winner.name;
                    $continent.textContent = party.continent = winner.continent;
                });

                $participant.append($label, $check);
                $matchInner.append($participant);
            }

            $match.addEventListener("knockoff", (e) => {
                /** @type {HTMLDivElement} */
                const $el = e.target;

                $el.classList.remove("proceed");

                // Knock-off the opponent
                knockOff($el.querySelector(".party:not(.loser)"));
            });

            $match.append($matchInner);
            $matches.append($match);
        }

        $round.append($matches);
        $chart.append($round);
    }
}

/**
 * @param {HTMLInputElement} $el
 * @param {import('./matches').Match} match
 * @param {import('./parties').Party} winner
 * @param {Round[]} rounds
 */
function winnerSelected($el, match, winner, rounds) {
    const $match = $el.offsetParent;
    const $matches = $match.parentElement;
    const $parties = $matches.querySelectorAll('input[type="radio"]');
    const nextRound = rounds[match.next.round];

    // Disable all radio buttons in current match
    enableParties($match, false);

    // Check if all match in the round already finish
    if (Array.from($parties).every(($radio) => $radio.disabled)) {
        const $round = $matches.parentElement;

        $round.classList.add("completed");
        enableParties($round.nextElementSibling);
    }

    $match.classList.add("proceed");
    $match.ariaDisabled = true;

    // Knock-off the opponent
    knockOff($match.querySelector(`[data-side=${flipSide(winner.side)}]`));

    if (!nextRound) {
        return;
    }

    // Find the target match on the next round
    const nextMatch = nextRound.matches.find(
        (related) => !!related.findParty(match)
    );
    // Find target party instance
    const party = nextMatch.findParty(match);
    // Find target party element
    const $party = document.getElementById(
        `round-${party.round}-match-${nextMatch.id}-${party.side}`
    );

    $party.dispatchEvent(
        new CustomEvent("assign-winner", {
            detail: winner,
        })
    );
}

/**
 * @param {HTMLDivElement} $opponent
 */
function knockOff($opponent) {
    const originMatch = $opponent.getAttribute("data-origin");

    // Mark the opponent as loser
    $opponent.classList.add("loser");

    if (originMatch) {
        const $originMatch = document.getElementById(originMatch);

        $originMatch.dispatchEvent(new CustomEvent("knockoff"));
    }
}

/**
 * @param {HTMLDivElement|null} $el
 * @param {boolean} enable
 */
function enableParties($el, enable = true) {
    if (!$el) {
        return;
    }

    const $parties = $el.querySelectorAll('input[type="radio"]');

    $parties.forEach(($radio) => ($radio.disabled = !enable));
}

/**
 * @param {import('./types').Side} side
 * @returns {import('./types').Side}
 */
function flipSide(side) {
    return { red: "blue", blue: "red" }[side];
}
