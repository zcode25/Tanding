<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tournament Bracket</title>
        <link rel="stylesheet" href="/css/bracket.css">
        <meta property="og:title" content="Tournament Bracket"/>
        <meta property="og:url" content="https://poc-brackets.feryardiant.id/"/>
        <meta property="og:image" content="https://repository-images.githubusercontent.com/887858620/ff2f4cec-940f-482b-a86d-97a169fde164"/>
        <meta property="og:description" content="My experiment and learn how to create single-elimination trounament-bracket."/>
        <script data-cfasync="false" nonce="c1851a93-f449-4476-b1e1-a4f7056c69b7">
            try {
                (function(w, d) {
                    !function(j, k, l, m) {
                        if (j.zaraz)
                            console.error("zaraz is loaded twice");
                        else {
                            j[l] = j[l] || {};
                            j[l].executed = [];
                            j.zaraz = {
                                deferred: [],
                                listeners: []
                            };
                            j.zaraz._v = "5850";
                            j.zaraz._n = "c1851a93-f449-4476-b1e1-a4f7056c69b7";
                            j.zaraz.q = [];
                            j.zaraz._f = function(n) {
                                return async function() {
                                    var o = Array.prototype.slice.call(arguments);
                                    j.zaraz.q.push({
                                        m: n,
                                        a: o
                                    })
                                }
                            }
                            ;
                            for (const p of ["track", "set", "debug"])
                                j.zaraz[p] = j.zaraz._f(p);
                            j.zaraz.init = () => {
                                var q = k.getElementsByTagName(m)[0]
                                  , r = k.createElement(m)
                                  , s = k.getElementsByTagName("title")[0];
                                s && (j[l].t = k.getElementsByTagName("title")[0].text);
                                j[l].x = Math.random();
                                j[l].w = j.screen.width;
                                j[l].h = j.screen.height;
                                j[l].j = j.innerHeight;
                                j[l].e = j.innerWidth;
                                j[l].l = j.location.href;
                                j[l].r = k.referrer;
                                j[l].k = j.screen.colorDepth;
                                j[l].n = k.characterSet;
                                j[l].o = (new Date).getTimezoneOffset();
                                if (j.dataLayer)
                                    for (const t of Object.entries(Object.entries(dataLayer).reduce(( (u, v) => ({
                                        ...u[1],
                                        ...v[1]
                                    })), {})))
                                        zaraz.set(t[0], t[1], {
                                            scope: "page"
                                        });
                                j[l].q = [];
                                for (; j.zaraz.q.length; ) {
                                    const w = j.zaraz.q.shift();
                                    j[l].q.push(w)
                                }
                                r.defer = !0;
                                for (const x of [localStorage, sessionStorage])
                                    Object.keys(x || {}).filter((z => z.startsWith("_zaraz_"))).forEach((y => {
                                        try {
                                            j[l]["z_" + y.slice(7)] = JSON.parse(x.getItem(y))
                                        } catch {
                                            j[l]["z_" + y.slice(7)] = x.getItem(y)
                                        }
                                    }
                                    ));
                                r.referrerPolicy = "origin";
                                r.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(j[l])));
                                q.parentNode.insertBefore(r, q)
                            }
                            ;
                            ["complete", "interactive"].includes(k.readyState) ? zaraz.init() : j.addEventListener("DOMContentLoaded", zaraz.init)
                        }
                    }(w, d, "zarazData", "script");
                    window.zaraz._p = async bs => new Promise((bt => {
                        if (bs) {
                            bs.e && bs.e.forEach((bu => {
                                try {
                                    const bv = d.querySelector("script[nonce]")
                                      , bw = bv?.nonce || bv?.getAttribute("nonce")
                                      , bx = d.createElement("script");
                                    bw && (bx.nonce = bw);
                                    bx.innerHTML = bu;
                                    bx.onload = () => {
                                        d.head.removeChild(bx)
                                    }
                                    ;
                                    d.head.appendChild(bx)
                                } catch (by) {
                                    console.error(`Error executing script: ${bu}\n`, by)
                                }
                            }
                            ));
                            Promise.allSettled((bs.f || []).map((bz => fetch(bz[0], bz[1]))))
                        }
                        bt()
                    }
                    ));
                    zaraz._p({
                        "e": ["(function(w,d){})(window,document)"]
                    });
                }
                )(window, document)
            } catch (e) {
                throw fetch("/cdn-cgi/zaraz/t"),
                e;
            }
            ;</script>
    </head>
    <body>
        <header class="container">
            <div>
                <h1>Tournament Bracket</h1>
                <p id="slider-hint" aria-hidden="false">
                    Use <kbd>Right</kbd>
                    or <kbd>Left</kbd>
                    arrow to change generated participants
                </p>
                <p id="upload-hint" aria-hidden="true">
                    Please download the <a href="/example/participant.csv">example</a>
                    to use upload
                </p>
            </div>
            <div id="options">
                <div id="selector">
                    <button class="options" data-target="#slider" tabindex="-1">Generate</button>
                    <button class="options" data-target="#upload" tabindex="-1">Upload</button>
                </div>
                <div id="slider" class="option" aria-describedby="#slider-hint" aria-hidden="false">
                    <label for="range">Generate</label>
                    <input id="range" type="range" name="range" min="3" max="50" value="3" placeholder="Generate participant" tabindex="-1">
                    <span id="value"></span>
                    <span>participants</span>
                </div>
                <form id="upload" class="option" aria-describedby="#upload-hint" aria-hidden="true">
                    <input type="file" name="parties" id="parties" accept="text/csv">
                </form>
            </div>
        </header>
        <main id="chart" class="container" tabindex="-1" style="--height: 92px; --width: 180px; --gap: 1em;"></main>
        <script type="module" src="/js/main.js"></script>
    </body>
</html>
