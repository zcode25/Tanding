export class Party {
    /** @type {number} Party ID */
    id = undefined;

    /** @type {string} Party name */
    name = "";

    /** @type {string|undefined} Party continent */
    continent = undefined;

    /** @type {import('./types').MatchPrev} */
    match = {};

    /** @type {import('./types').Side|undefined} */
    side = undefined;

    get label() {
        if (!this.continent) {
            return this.name;
        }

        return `${this.name} from ${this.continent}`;
    }

    /**
     * @param {string} name
     * @param {number|undefined} id
     * @param {string|undefined} continent
     */
    constructor(name, id = undefined, continent = undefined) {
        this.id = id;
        this.name = name;
        this.continent = continent;
        this.order = id || 0;
    }

    /**
     * @param {number} total
     * @param {import('./types').Side} side
     * @returns {Party}
     */
    normalize(total, side) {
        this.order = +(this.order / total).toPrecision(3);

        if (side && !this.side) {
            this.side = side;
        }

        return this;
    }

    /**
     * Add information about the source match.
     *
     * @param {import('./matches').Match} match
     * @param {number} index
     * @param {number} totalMatches
     */
    fromMatch(match, index, totalMatches) {
        this.round = match.next.round;
        this.side = match.next.side;
        this.order = index + 1;
        this.match = {
            id: match.id,
            round: match.round,
            size: match.size,
            span: match.next.span,
            index,
        };

        return this.normalize(totalMatches + match.round, this.side);
    }
}

/**
 * Generate participants base on desired number of participant.
 *
 * @param {number} length Number of participants
 */
export function generateParties(length) {
    const parties = [...Array.from({ length }).keys()].map((i) => {
        const id = i + 1;
        return new Party(`Participant ${id}`, id, `Continent ${id}`);
    });

    return determinePartiesSide(parties);
}

/**
 * Determine match side for each participant.
 *
 * @param {Party[]} parties List of available participants
 * @returns {Party[]}
 */
export function determinePartiesSide(parties) {
    let chunks = [];
    let half = parties.length;

    // Split each participants into chunked blue and red with criteria of
    // each chunk can only consist of max 2 blues and 1 red
    while (half >= 1) {
        half = Math.floor(half / 2);

        if (chunks.length === 0) {
            chunks.push(sliceParties(parties, half));

            continue;
        }

        // Recursively splits each halfs
        const parts = [];

        for (const chunk of chunks) {
            if (chunk.upper.length === 1 && chunk.lower.length === 1) {
                parts.push(chunk);
                continue;
            }

            // On last chunk iteration that has 2 upper and 1 lower
            // Swap their participant to the correct allocation
            if (chunk.upper.length === 2 && chunk.lower.length === 1) {
                chunk.lower.unshift(chunk.upper.splice(1, 1)[0]);
            }

            for (const side of Object.values(chunk)) {
                if (side.length > 1) {
                    parts.push(sliceParties(side, half));
                    continue;
                }

                parts.push({ upper: side, lower: [] });
            }
        }

        chunks = [];
        chunks.push(...parts);
    }

    return chunks.reduce((returns, chunk) => {
        returns.push(chunk.upper[0].normalize(parties.length, "blue"));

        if (chunk.lower[0]) {
            returns.push(chunk.lower[0].normalize(parties.length, "red"));
        }

        return returns;
    }, []);
}

/**
 * Predetermine party side.
 *
 * @typedef {object} Sliced
 * @property {Party[]} upper Upper side participant
 * @property {Party[]} lower Lower side participant
 *
 * @param {Party[]} parties List of available participants
 * @param {number} slice Number of slices
 * @returns {Sliced}
 */
function sliceParties(parties, slice) {
    if (Math.floor(parties.length / 2) > slice) {
        slice++;
    }

    return {
        upper: parties.slice(0, slice),
        lower: parties.slice(slice),
    };
}
