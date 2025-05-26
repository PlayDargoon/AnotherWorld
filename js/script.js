( () => {
    "use strict";
    function e(e, t, s, o, r, l, i, c) {
        var a, n = "function" == typeof e ? e.options : e;
        if (t && (n.render = t,
        n.staticRenderFns = s,
        n._compiled = !0),
        o && (n.functional = !0),
        l && (n._scopeId = "data-v-" + l),
        i ? (a = function(e) {
            (e = e || this.$vnode && this.$vnode.ssrContext || this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) || "undefined" == typeof __VUE_SSR_CONTEXT__ || (e = __VUE_SSR_CONTEXT__),
            r && r.call(this, e),
            e && e._registeredComponents && e._registeredComponents.add(i)
        }
        ,
        n._ssrRegister = a) : r && (a = c ? function() {
            r.call(this, (n.functional ? this.parent : this).$root.$options.shadowRoot)
        }
        : r),
        a)
            if (n.functional) {
                n._injectStyles = a;
                var d = n.render;
                n.render = function(e, t) {
                    return a.call(t),
                    d(e, t)
                }
            } else {
                var u = n.beforeCreate;
                n.beforeCreate = u ? [].concat(u, a) : [a]
            }
        return {
            exports: e,
            options: n
        }
    }
    const t = e({
        props: {
            fill: {
                type: String,
                default: "rgba(255, 255, 255, 0.9)"
            },
            stroke: {
                type: String,
                default: "transparent"
            },
            viewBox: String,
            path: String
        }
    }, (function() {
        var e = this
          , t = e._self._c;
        return t("svg", {
            staticStyle: {
                display: "none",
                "pointer-events": "none"
            },
            attrs: {
                xmlns: "http://www.w3.org/2000/svg",
                "xmlns:xlink": "http://www.w3.org/1999/xlink",
                viewBox: e.viewBox,
                width: "100%",
                height: "100%",
                preserveAspectRatio: "none"
            }
        }, [t("path", {
            attrs: {
                fill: e.fill,
                stroke: e.stroke,
                d: e.path
            }
        })])
    }
    ), [], !1, null, null, null).exports
      , s = {
        c: "arrow-c",
        metal: "arrow-metal",
        image: "arrow-image",
        details: "arrow-details"
    };
    const o = e({
        components: {
            SvgTemplate: t
        },
        props: {
            type: {
                type: String,
                default: "raster"
            },
            background: String,
            image: String,
            fill: String,
            stroke: String
        },
        data: () => ({
            svg: {
                next: {
                    viewBox: "0 0 19 31",
                    path: "M-0.000,-0.000 L19.000,15.500 L-0.000,31.000 L12.500,15.500 L-0.000,-0.000 Z"
                },
                prev: {
                    viewBox: "0 0 19 31",
                    path: "M19.000,-0.000 L-0.000,15.500 L19.000,31.000 L6.500,15.500 L19.000,-0.000 Z"
                },
                down: {
                    viewBox: "0 0 17 11",
                    path: "M0,0L8.5,11,17,0,8.5,7.237Z"
                }
            }
        })
    }, (function() {
        var e = this
          , t = e._self._c;
        return t("div", {
            class: [e.$style.c, e.$style[e.background]],
            on: {
                click: function(t) {
                    return e.$emit("click")
                }
            }
        }, ["raster" === e.type ? t("div", {
            class: [e.$style.image, e.$style[e.image]]
        }) : t("SvgTemplate", {
            attrs: {
                fill: e.fill,
                stroke: e.stroke,
                "view-box": e.svg[e.image].viewBox,
                path: e.svg[e.image].path
            }
        })], 1)
    }
    ), [], !1, (function(e) {
        this.$style = s.locals || s
    }
    ), null, null).exports
      , r = Ptx.Utils.Console({
        source: "Customize"
    })
      , l = {
        roleLook: "customize-roleLook",
        roleIcon: "customize-roleIcon",
        selectorSides: "customize-selectorSides",
        selectorGenders: "customize-selectorGenders",
        selectors: "customize-selectors",
        stats: "customize-stats",
        statDescription: "customize-statDescription",
        stat: "customize-stat",
        statsTitle: "customize-statsTitle",
        roleIcons: "customize-roleIcons",
        header: "customize-header",
        c: "customize-c",
        backMain: "customize-backMain",
        backSelectors: "customize-backSelectors",
        view: "customize-view",
        roleIconWrap: "customize-roleIconWrap",
        roleIconActive: "customize-roleIconActive",
        roleName: "customize-roleName",
        roleStats: "customize-roleStats",
        statImg: "customize-statImg",
        statText: "customize-statText",
        statNumber: "customize-statNumber",
        statProgressBar: "customize-statProgressBar",
        statProgressBarFill: "customize-statProgressBarFill",
        roleLookWrap: "customize-roleLookWrap",
        roleLookActive: "customize-roleLookActive",
        roleLookBackground: "customize-roleLookBackground",
        roleLookForeground: "customize-roleLookForeground",
        arrowPrev: "customize-arrowPrev",
        arrowNext: "customize-arrowNext",
        selectorGender: "customize-selectorGender",
        selectorSide: "customize-selectorSide",
        buttonPlay: "customize-buttonPlay",
        roleDescription: "customize-roleDescription",
        sep: "customize-sep",
        light: "customize-light",
        dark: "customize-dark"
    };
    const i = e({
        components: {
            Arrow: o
        },
        data: () => ({
            userDelay: null,
            clickTimer: null,
            gesture: null,
            selected: {
                side: Ptx.Utils.rngInt(0, 1) || 0,
                gender: Ptx.Utils.rngInt(0, 1) || 0,
                role: Ptx.Utils.rngInt(0, 2) || 0
            },
            props: {
                stats: {
                    max: 50,
                    list: [{
                        id: "vitality",
                        name: "Здоровье",
                        current: 0
                    }, {
                        id: "damage",
                        name: "Урон",
                        current: 0
                    }, {
                        id: "defence",
                        name: "Защита",
                        current: 0
                    }]
                }
            },
            roles: [{
                name: "Маг",
                desc: "Маги силой своих заклинаний наносят колоссальный урон врагу или поражают большие скопления противников.",
                amulets: [{
                    name: "Приток Силы",
                    frame: 1,
                    desc: "Краткое описание амулета"
                }, {
                    name: "Взрыв Эфира",
                    frame: 2,
                    desc: "Краткое описание амулета"
                }, {
                    name: "Тень Смерти",
                    frame: 3,
                    desc: "Краткое описание амулета"
                }],
                stats: {
                    vitality: 25,
                    damage: 50,
                    defence: 25
                }
            }, {
                name: "Монах",
                desc: "Монахи - незаменимые лекари в бою. Обретая форму Демонов, разрывают своих врагов.",
                amulets: [{
                    name: "Листок Лотоса",
                    frame: 4,
                    desc: "Краткое описание амулета"
                }, {
                    name: "Форма Демона",
                    frame: 5,
                    desc: "Краткое описание амулета"
                }, {
                    name: "Кровавый Цветок",
                    frame: 6,
                    desc: "Краткое описание амулета"
                }],
                stats: {
                    vitality: 40,
                    damage: 40,
                    defence: 20
                }
            }, {
                name: "Воин",
                desc: "Воины защищают друзей, принимая урон врагов на себя. Имеют большую живучесть и способны уворачиваться от ударов.",
                amulets: [{
                    name: "Ярость Богов",
                    frame: 7,
                    desc: "Краткое описание амулета"
                }, {
                    name: "Рывок Жизни",
                    frame: 8,
                    desc: "Краткое описание амулета"
                }, {
                    name: "Защита Богов",
                    frame: 9,
                    desc: "Краткое описание амулета"
                }],
                stats: {
                    vitality: 20,
                    damage: 30,
                    defence: 50
                }
            }]
        }),
        methods: {
            writeMetric(e) {
                try {
                    ym(window.ptxYmCounterId, "reachGoal", e)
                } catch (t) {
                    r("Write metric error, with event:", e, t)
                }
                try {
                    Ptx.Shadows.Ui.Customize.callbackUserAction && Ptx.Shadows.Ui.Customize.callbackUserAction(e)
                } catch (e) {}
            },
            roleList(e) {
                "-" === e ? 0 !== this.selected.role ? this.selected.role-- : this.selected.role = 2 : "+" === e ? 2 !== this.selected.role ? this.selected.role++ : this.selected.role = 0 : this.selected.role = e,
                this.props.stats.list.forEach((e => {
                    gsap.to(e, {
                        duration: .3,
                        current: this.roles[this.selected.role].stats[e.id],
                        ease: "none"
                    })
                }
                )),
                this.roleLookVFX(300),
                this.writeMetric("customization_flipping_classes")
            },
            genderList(e) {
                this.selected.gender = e,
                this.roleLookVFX(0),
                this.writeMetric("customization_gender_selection")
            },
            sideList(e) {
                this.selected.side = e,
                this.roleLookVFX(0),
                this.writeMetric("customization_side_selection")
            },
            roleLookVFX(e) {
                null === this.userDelay && (this.userDelay = Ptx.Utils.createPromise(),
                this.userDelay.then(( () => {
                    gsap.fromTo([this.$refs.roleLookBackground, this.$refs.roleLookForeground], {
                        opacity: 1
                    }, {
                        duration: 1,
                        ease: "none",
                        opacity: 0
                    })
                }
                ))),
                null === this.clickTimer ? this.clickTimer = Ptx.setTimeout(( () => {
                    this.clickTimer = null,
                    this.userDelay.resolve(),
                    this.userDelay = null
                }
                ), e) : (clearTimeout(this.clickTimer),
                this.clickTimer = null)
            },
            play() {
                var e;
                let t = ((null === (e = Ptx.Shadows) || void 0 === e || null === (e = e.Tutor) || void 0 === e ? void 0 : e.urlStart) || "https://m.vten.ru/user/customize?ppAction=select") + "&sex=" + (0 === this.selected.gender ? "m" : "f") + "&side=" + (this.selected.side + 1) + "&type=" + (this.selected.role + 1);
                ptxLocLoad(t),
                this.writeMetric("customization_play")
            }
        },
        mounted() {
            this.props.stats.list.forEach((e => e.current = this.roles[this.selected.role].stats[e.id])),
            this.gesture = new Ptx.Utils.Gesture(this.$refs.customizeView,{
                contextMenu: !1,
                scroll: !1
            }),
            this.gesture.on("swiperight", ( () => this.roleList("-"))),
            this.gesture.on("swipeleft", ( () => this.roleList("+")))
        },
        beforeDestroy() {
            this.gesture.destroy()
        }
    }, (function() {
        var e = this
          , t = e._self._c;
        return t("div", {
            class: [e.$style.c, 0 === e.selected.side ? e.$style.light : e.$style.dark]
        }, [t("div", {
            class: e.$style.backMain
        }), e._v(" "), t("div", {
            class: e.$style.backSelectors
        }), e._v(" "), t("div", {
            class: e.$style.header
        }, [t("span", [e._v("Выбери класс героя")])]), e._v(" "), t("div", {
            ref: "customizeView",
            class: e.$style.view
        }, [t("div", {
            class: e.$style.roleStats
        }, [t("div", {
            class: e.$style.roleIcons
        }, [t("div", {
            class: e.$style.roleIconWrap
        }, [t("div", {
            class: [e.$style.roleIcon, 0 === e.selected.role ? e.$style.roleIconActive : ""],
            style: {
                transform: `translateX(${0 === e.selected.role ? 0 : 1 === e.selected.role ? -125 : 125}%)`,
                backgroundPositionX: "0%"
            }
        }), e._v(" "), t("div", {
            class: [e.$style.roleIcon, 1 === e.selected.role ? e.$style.roleIconActive : ""],
            style: {
                transform: `translateX(${0 === e.selected.role ? 125 : 1 === e.selected.role ? 0 : -125}%)`,
                backgroundPositionX: "50%"
            }
        }), e._v(" "), t("div", {
            class: [e.$style.roleIcon, 2 === e.selected.role ? e.$style.roleIconActive : ""],
            style: {
                transform: `translateX(${0 === e.selected.role ? -125 : 1 === e.selected.role ? 125 : 0}%)`,
                backgroundPositionX: "100%"
            }
        })])]), e._v(" "), t("span", {
            class: e.$style.roleName
        }, [e._v(e._s(e.roles[e.selected.role].name))]), e._v(" "), t("div", {
            class: e.$style.roleDescription
        }, [t("span", {
            domProps: {
                innerHTML: e._s(e.roles[e.selected.role].desc)
            }
        })]), e._v(" "), t("div", {
            class: e.$style.sep
        }), e._v(" "), t("div", {
            class: e.$style.stats
        }, [t("span", {
            class: e.$style.statsTitle
        }, [e._v("Характеристики")]), e._v(" "), e._l(e.props.stats.list, (function(s, o) {
            return t("div", {
                class: e.$style.stat
            }, [t("div", {
                class: e.$style.statImg,
                style: {
                    backgroundPositionY: 50 * o + "%"
                }
            }), e._v(" "), t("div", {
                class: e.$style.statDescription
            }, [t("div", {
                class: e.$style.statText
            }, [t("span", {
                class: e.$style.statName
            }, [e._v(e._s(s.name))]), e._v(" "), t("span", {
                class: e.$style.statNumber
            }, [e._v(e._s(e.props.stats.list.find((e => s.id === e.id)).current.toFixed(0)))])]), e._v(" "), t("div", {
                class: e.$style.statProgressBar
            }, [t("div", {
                class: e.$style.statProgressBarFill,
                style: {
                    width: e.props.stats.list.find((e => s.id === e.id)).current / (e.props.stats.max / 100) + "%"
                }
            })])])])
        }
        ))], 2)]), e._v(" "), t("div", {
            class: e.$style.roleLookWrap
        }, [t("div", {
            ref: "roleLookBackground",
            class: e.$style.roleLookBackground
        }), e._v(" "), t("div", {
            ref: "roleLookForeground",
            class: e.$style.roleLookForeground
        }), e._v(" "), t("div", {
            class: [e.$style.roleLook, 0 === e.selected.role ? e.$style.roleLookActive : ""],
            style: {
                transform: `translateX(${0 === e.selected.role ? 0 : 1 === e.selected.role ? -50 : 50}%)`,
                backgroundPositionX: 20 * e.selected.gender + "%"
            }
        }), e._v(" "), t("div", {
            class: [e.$style.roleLook, 1 === e.selected.role ? e.$style.roleLookActive : ""],
            style: {
                transform: `translateX(${0 === e.selected.role ? 50 : 1 === e.selected.role ? 0 : -50}%)`,
                backgroundPositionX: 20 * (2 + e.selected.gender) + "%"
            }
        }), e._v(" "), t("div", {
            class: [e.$style.roleLook, 2 === e.selected.role ? e.$style.roleLookActive : ""],
            style: {
                transform: `translateX(${0 === e.selected.role ? -50 : 1 === e.selected.role ? 50 : 0}%)`,
                backgroundPositionX: 20 * (4 + e.selected.gender) + "%"
            }
        })]), e._v(" "), t("Arrow", {
            class: e.$style.arrowPrev,
            attrs: {
                type: "svg",
                image: "prev"
            },
            on: {
                click: function(t) {
                    return e.roleList("-")
                }
            }
        }), e._v(" "), t("Arrow", {
            class: e.$style.arrowNext,
            attrs: {
                type: "svg",
                image: "next"
            },
            on: {
                click: function(t) {
                    return e.roleList("+")
                }
            }
        })], 1), e._v(" "), t("div", {
            class: e.$style.selectors
        }, [t("span", {
            class: e.$style.selectorTitle
        }, [e._v("Выбери пол героя")]), e._v(" "), t("div", {
            class: e.$style.selectorGenders
        }, [t("div", {
            class: e.$style.selectorGender,
            style: {
                backgroundPosition: "0% " + (4 * e.selected.side + e.selected.gender) * (100 / 7) + "%"
            },
            on: {
                click: function(t) {
                    return e.genderList(0)
                }
            }
        }), e._v(" "), t("div", {
            class: e.$style.selectorGender,
            style: {
                backgroundPosition: "0% " + (4 * e.selected.side + 3 - e.selected.gender) * (100 / 7) + "%"
            },
            on: {
                click: function(t) {
                    return e.genderList(1)
                }
            }
        })]), e._v(" "), t("span", {
            class: e.$style.selectorTitle
        }, [e._v("Выбери сторону")]), e._v(" "), t("div", {
            class: e.$style.selectorSides
        }, [t("div", {
            class: e.$style.selectorSide,
            style: {
                backgroundPosition: "0% " + e.selected.side * (100 / 3) + "%"
            },
            on: {
                click: function(t) {
                    return e.sideList(0)
                }
            }
        }), e._v(" "), t("div", {
            class: e.$style.selectorSide,
            style: {
                backgroundPosition: "0% " + (3 - e.selected.side) * (100 / 3) + "%"
            },
            on: {
                click: function(t) {
                    return e.sideList(1)
                }
            }
        })]), e._v(" "), t("div", {
            class: e.$style.buttonPlay,
            on: {
                click: e.play
            }
        })])])
    }
    ), [], !1, (function(e) {
        this.$style = l.locals || l
    }
    ), null, null).exports;
    Ptx.Utils.initVueApp({
        app: () => {
            const e = "customize";
            return {
                name: e,
                init: () => new Vue({
                    el: "#" + e,
                    components: {
                        Customize: i
                    }
                })
            }
        }
    })
}
)();