try {
    (function (w, d) {
        zaraz.debug = (py = "") => {
            document.cookie = `zarazDebug=${py}; path=/`;
            location.reload();
        };
        window.zaraz._al = function (oP, oQ, oR) {
            w.zaraz.listeners.push({
                item: oP,
                type: oQ,
                callback: oR,
            });
            oP.addEventListener(oQ, oR);
        };
        zaraz.preview = (oS = "") => {
            document.cookie = `zarazPreview=${oS}; path=/`;
            location.reload();
        };
        zaraz.i = function (pH) {
            const pI = d.createElement("div");
            pI.innerHTML = unescape(pH);
            const pJ = pI.querySelectorAll("script"),
                pK = d.querySelector("script[nonce]"),
                pL = pK?.nonce || pK?.getAttribute("nonce");
            for (let pM = 0; pM < pJ.length; pM++) {
                const pN = d.createElement("script");
                pL && (pN.nonce = pL);
                pJ[pM].innerHTML && (pN.innerHTML = pJ[pM].innerHTML);
                for (const pO of pJ[pM].attributes)
                    pN.setAttribute(pO.name, pO.value);
                d.head.appendChild(pN);
                pJ[pM].remove();
            }
            d.body.appendChild(pI);
        };
        zaraz.f = async function (pv, pw) {
            const px = {
                credentials: "include",
                keepalive: !0,
                mode: "no-cors",
            };
            if (pw) {
                px.method = "POST";
                px.body = new URLSearchParams(pw);
                px.headers = {
                    "Content-Type": "application/x-www-form-urlencoded",
                };
            }
            return await fetch(pv, px);
        };
        window.zaraz._p = async (bs) =>
            new Promise((bt) => {
                if (bs) {
                    bs.e &&
                        bs.e.forEach((bu) => {
                            try {
                                const bv = d.querySelector("script[nonce]"),
                                    bw = bv?.nonce || bv?.getAttribute("nonce"),
                                    bx = d.createElement("script");
                                bw && (bx.nonce = bw);
                                bx.innerHTML = bu;
                                bx.onload = () => {
                                    d.head.removeChild(bx);
                                };
                                d.head.appendChild(bx);
                            } catch (by) {
                                console.error(
                                    `Error executing script: ${bu}\n`,
                                    by
                                );
                            }
                        });
                    Promise.allSettled(
                        (bs.f || []).map((bz) => fetch(bz[0], bz[1]))
                    );
                }
                bt();
            });
        zaraz.pageVariables = {};
        zaraz.__zcl = zaraz.__zcl || {};
        zaraz.track = async function (oW, oX, oY) {
            return new Promise((oZ, o$) => {
                const pa = {
                    name: oW,
                    data: {},
                };
                if (oX?.__zarazClientEvent)
                    Object.keys(localStorage)
                        .filter((pc) => pc.startsWith("_zaraz_google_consent_"))
                        .forEach(
                            (pb) => (pa.data[pb] = localStorage.getItem(pb))
                        );
                else {
                    for (const pd of [localStorage, sessionStorage])
                        Object.keys(pd || {})
                            .filter((pf) => pf.startsWith("_zaraz_"))
                            .forEach((pe) => {
                                try {
                                    pa.data[pe.slice(7)] = JSON.parse(
                                        pd.getItem(pe)
                                    );
                                } catch {
                                    pa.data[pe.slice(7)] = pd.getItem(pe);
                                }
                            });
                    Object.keys(zaraz.pageVariables).forEach(
                        (pg) =>
                            (pa.data[pg] = JSON.parse(zaraz.pageVariables[pg]))
                    );
                }
                Object.keys(zaraz.__zcl).forEach(
                    (ph) => (pa.data[`__zcl_${ph}`] = zaraz.__zcl[ph])
                );
                pa.data.__zarazMCListeners = zaraz.__zarazMCListeners;
                //
                pa.data = {
                    ...pa.data,
                    ...oX,
                };
                pa.zarazData = zarazData;
                fetch("/cdn-cgi/zaraz/t", {
                    credentials: "include",
                    keepalive: !0,
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(pa),
                })
                    .catch(() => {
                        //
                        return fetch("/cdn-cgi/zaraz/t", {
                            credentials: "include",
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify(pa),
                        });
                    })
                    .then(function (pj) {
                        zarazData._let = new Date().getTime();
                        pj.ok || o$();
                        return 204 !== pj.status && pj.json();
                    })
                    .then(async (pi) => {
                        await zaraz._p(pi);
                        "function" == typeof oY && oY();
                    })
                    .finally(() => oZ());
            });
        };
        zaraz.set = function (pk, pl, pm) {
            try {
                pl = JSON.stringify(pl);
            } catch (pn) {
                return;
            }
            prefixedKey = "_zaraz_" + pk;
            sessionStorage && sessionStorage.removeItem(prefixedKey);
            localStorage && localStorage.removeItem(prefixedKey);
            delete zaraz.pageVariables[pk];
            if (void 0 !== pl) {
                pm && "session" == pm.scope
                    ? sessionStorage && sessionStorage.setItem(prefixedKey, pl)
                    : pm && "page" == pm.scope
                    ? (zaraz.pageVariables[pk] = pl)
                    : localStorage && localStorage.setItem(prefixedKey, pl);
                zaraz.__watchVar = {
                    key: pk,
                    value: pl,
                };
            }
        };
        for (const { m: po, a: pp } of zarazData.q.filter(({ m: pq }) =>
            ["debug", "set"].includes(pq)
        ))
            zaraz[po](...pp);
        for (const { m: pr, a: ps } of zaraz.q) zaraz[pr](...ps);
        delete zaraz.q;
        delete zarazData.q;
        zaraz.spaPageview = () => {
            zarazData.l = d.location.href;
            zarazData.t = d.title;
            zaraz.pageVariables = {};
            zaraz.__zarazMCListeners = {};
            zaraz.track("__zarazSPA");
        };
        zaraz.fulfilTrigger = function (oo, op, oq, or) {
            zaraz.__zarazTriggerMap || (zaraz.__zarazTriggerMap = {});
            zaraz.__zarazTriggerMap[oo] || (zaraz.__zarazTriggerMap[oo] = "");
            zaraz.__zarazTriggerMap[oo] += "*" + op + "*";
            zaraz.track(
                "__zarazEmpty",
                {
                    ...oq,
                    __zarazClientTriggers: zaraz.__zarazTriggerMap[oo],
                },
                or
            );
        };
        zaraz._processDataLayer = (pA) => {
            for (const pB of Object.entries(pA))
                zaraz.set(pB[0], pB[1], {
                    scope: "page",
                });
            if (pA.event) {
                if (
                    zarazData.dataLayerIgnore &&
                    zarazData.dataLayerIgnore.includes(pA.event)
                )
                    return;
                let pC = {};
                for (let pD of dataLayer.slice(0, dataLayer.indexOf(pA) + 1))
                    pC = {
                        ...pC,
                        ...pD,
                    };
                delete pC.event;
                pA.event.startsWith("gtm.") || zaraz.track(pA.event, pC);
            }
        };
        window.dataLayer = w.dataLayer || [];
        const pz = w.dataLayer.push;
        Object.defineProperty(w.dataLayer, "push", {
            configurable: !0,
            enumerable: !1,
            writable: !0,
            value: function (...pE) {
                let pF = pz.apply(this, pE);
                zaraz._processDataLayer(pE[0]);
                return pF;
            },
        });
        dataLayer.forEach((pG) => zaraz._processDataLayer(pG));
        zaraz._cts = () => {
            zaraz._timeouts &&
                zaraz._timeouts.forEach((nS) => clearTimeout(nS));
            zaraz._timeouts = [];
        };
        zaraz._rl = function () {
            w.zaraz.listeners &&
                w.zaraz.listeners.forEach((nT) =>
                    nT.item.removeEventListener(nT.type, nT.callback)
                );
            window.zaraz.listeners = [];
        };
        history.pushState = function () {
            try {
                zaraz._rl();
                zaraz._cts && zaraz._cts();
            } finally {
                History.prototype.pushState.apply(history, arguments);
                setTimeout(zaraz.spaPageview, 100);
            }
        };
        history.replaceState = function () {
            try {
                zaraz._rl();
                zaraz._cts && zaraz._cts();
            } finally {
                History.prototype.replaceState.apply(history, arguments);
                setTimeout(zaraz.spaPageview, 100);
            }
        };
        zaraz._c = (nP) => {
            const { event: nQ, ...nR } = nP;
            zaraz.track(nQ, {
                ...nR,
                __zarazClientEvent: !0,
            });
        };
        zaraz._syncedAttributes = [
            "altKey",
            "clientX",
            "clientY",
            "pageX",
            "pageY",
            "button",
        ];
        zaraz.__zcl.track = !0;
        d.addEventListener("visibilitychange", (md) => {
            zaraz._c(
                {
                    event: "visibilityChange",
                    visibilityChange: [
                        {
                            state: d.visibilityState,
                            timestamp: new Date().getTime(),
                        },
                    ],
                },
                1
            );
        });
        zaraz.__zcl.visibilityChange = !0;
        zaraz.__zarazMCListeners = {
            "google-analytics_v4_ZFiw": ["visibilityChange"],
        };
        zaraz._p({
            e: [
                '(function(w,d){;w.zarazData.executed.push("Pageview");})(window,document)',
                "(function(w,d){})(window,document)",
            ],
            f: [
                [
                    "https://stats.g.doubleclick.net/g/collect?t=dc&aip=1&_r=3&v=1&_v=j86&tid=G-2D8122B4WR&cid=2bb33a52-22ff-48b1-b360-befcfdf2c8c5&_u=KGDAAEADQAAAAC%7E&z=1775781815",
                    {},
                ],
            ],
        });
    })(window, document);
} catch (e) {
    throw (fetch("/cdn-cgi/zaraz/t"), e);
}
