var R = {}, H;
function V() {
  return H || (H = 1, (function(D) {
    D();
  })((function() {
    var D, _ = (function(P, Y) {
      return P(Y = { exports: {} }, Y.exports), Y.exports;
    })((function(P, Y) {
      var z;
      z = function() {
        return (function(S) {
          var e = {};
          function i(t) {
            if (e[t]) return e[t].exports;
            var r = e[t] = { i: t, l: !1, exports: {} };
            return S[t].call(r.exports, r, r.exports, i), r.l = !0, r.exports;
          }
          return i.m = S, i.c = e, i.d = function(t, r, s) {
            i.o(t, r) || Object.defineProperty(t, r, { enumerable: !0, get: s });
          }, i.r = function(t) {
            typeof Symbol < "u" && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(t, "__esModule", { value: !0 });
          }, i.t = function(t, r) {
            if (1 & r && (t = i(t)), 8 & r || 4 & r && typeof t == "object" && t && t.__esModule) return t;
            var s = /* @__PURE__ */ Object.create(null);
            if (i.r(s), Object.defineProperty(s, "default", { enumerable: !0, value: t }), 2 & r && typeof t != "string") for (var a in t) i.d(s, a, (function(l) {
              return t[l];
            }).bind(null, a));
            return s;
          }, i.n = function(t) {
            var r = t && t.__esModule ? function() {
              return t.default;
            } : function() {
              return t;
            };
            return i.d(r, "a", r), r;
          }, i.o = function(t, r) {
            return Object.prototype.hasOwnProperty.call(t, r);
          }, i.p = "", i(i.s = 44);
        })([function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t = i(19);
          Object.keys(t).forEach((function(r) {
            r !== "default" && r !== "__esModule" && Object.defineProperty(e, r, { enumerable: !0, get: function() {
              return t[r];
            } });
          }));
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = i(22), s = (t = r) && t.__esModule ? t : { default: t };
          e.default = s.default;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t = i(26);
          Object.defineProperty(e, "closest", { enumerable: !0, get: function() {
            return s(t).default;
          } });
          var r = i(24);
          function s(a) {
            return a && a.__esModule ? a : { default: a };
          }
          Object.defineProperty(e, "requestNextAnimationFrame", { enumerable: !0, get: function() {
            return s(r).default;
          } });
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = i(42), s = (t = r) && t.__esModule ? t : { default: t };
          e.default = s.default;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = i(35), s = (t = r) && t.__esModule ? t : { default: t };
          e.default = s.default;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t = i(1);
          Object.defineProperty(e, "Sensor", { enumerable: !0, get: function() {
            return m(t).default;
          } });
          var r = i(21);
          Object.defineProperty(e, "MouseSensor", { enumerable: !0, get: function() {
            return m(r).default;
          } });
          var s = i(18);
          Object.defineProperty(e, "TouchSensor", { enumerable: !0, get: function() {
            return m(s).default;
          } });
          var a = i(16);
          Object.defineProperty(e, "DragSensor", { enumerable: !0, get: function() {
            return m(a).default;
          } });
          var l = i(14);
          Object.defineProperty(e, "ForceTouchSensor", { enumerable: !0, get: function() {
            return m(l).default;
          } });
          var d = i(0);
          function m(u) {
            return u && u.__esModule ? u : { default: u };
          }
          Object.keys(d).forEach((function(u) {
            u !== "default" && u !== "__esModule" && Object.defineProperty(e, u, { enumerable: !0, get: function() {
              return d[u];
            } });
          }));
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t = i(37);
          Object.defineProperty(e, "Announcement", { enumerable: !0, get: function() {
            return l(t).default;
          } }), Object.defineProperty(e, "defaultAnnouncementOptions", { enumerable: !0, get: function() {
            return t.defaultOptions;
          } });
          var r = i(34);
          Object.defineProperty(e, "Focusable", { enumerable: !0, get: function() {
            return l(r).default;
          } });
          var s = i(32);
          Object.defineProperty(e, "Mirror", { enumerable: !0, get: function() {
            return l(s).default;
          } }), Object.defineProperty(e, "defaultMirrorOptions", { enumerable: !0, get: function() {
            return s.defaultOptions;
          } });
          var a = i(28);
          function l(d) {
            return d && d.__esModule ? d : { default: d };
          }
          Object.defineProperty(e, "Scrollable", { enumerable: !0, get: function() {
            return l(a).default;
          } }), Object.defineProperty(e, "defaultScrollableOptions", { enumerable: !0, get: function() {
            return a.defaultOptions;
          } });
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t = i(38);
          Object.keys(t).forEach((function(r) {
            r !== "default" && r !== "__esModule" && Object.defineProperty(e, r, { enumerable: !0, get: function() {
              return t[r];
            } });
          }));
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t = i(39);
          Object.keys(t).forEach((function(r) {
            r !== "default" && r !== "__esModule" && Object.defineProperty(e, r, { enumerable: !0, get: function() {
              return t[r];
            } });
          }));
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t = i(43);
          Object.keys(t).forEach((function(r) {
            r !== "default" && r !== "__esModule" && Object.defineProperty(e, r, { enumerable: !0, get: function() {
              return t[r];
            } });
          }));
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 }), e.default = class {
            constructor() {
              this.callbacks = {};
            }
            on(t, ...r) {
              return this.callbacks[t] || (this.callbacks[t] = []), this.callbacks[t].push(...r), this;
            }
            off(t, r) {
              if (!this.callbacks[t]) return null;
              const s = this.callbacks[t].slice(0);
              for (let a = 0; a < s.length; a++) r === s[a] && this.callbacks[t].splice(a, 1);
              return this;
            }
            trigger(t) {
              if (!this.callbacks[t.type]) return null;
              const r = [...this.callbacks[t.type]], s = [];
              for (let a = r.length - 1; a >= 0; a--) {
                const l = r[a];
                try {
                  l(t);
                } catch (d) {
                  s.push(d);
                }
              }
              return s.length && console.error(`Draggable caught errors while triggering '${t.type}'`, s), this;
            }
          };
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = i(10), s = (t = r) && t.__esModule ? t : { default: t };
          e.default = s.default;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 }), e.defaultOptions = void 0;
          var t, r = Object.assign || function(x) {
            for (var h = 1; h < arguments.length; h++) {
              var c = arguments[h];
              for (var y in c) Object.prototype.hasOwnProperty.call(c, y) && (x[y] = c[y]);
            }
            return x;
          }, s = i(2), a = i(6), l = i(11), d = (t = l) && t.__esModule ? t : { default: t }, m = i(5), u = i(7), p = i(8);
          const w = Symbol("onDragStart"), C = Symbol("onDragMove"), b = Symbol("onDragStop"), f = Symbol("onDragPressure"), o = { "drag:start": (x) => `Picked up ${x.source.textContent.trim() || x.source.id || "draggable element"}`, "drag:stop": (x) => `Released ${x.source.textContent.trim() || x.source.id || "draggable element"}` }, n = { "container:dragging": "draggable-container--is-dragging", "source:dragging": "draggable-source--is-dragging", "source:placed": "draggable-source--placed", "container:placed": "draggable-container--placed", "body:dragging": "draggable--is-dragging", "draggable:over": "draggable--over", "container:over": "draggable-container--over", "source:original": "draggable--original", mirror: "draggable-mirror" }, g = e.defaultOptions = { draggable: ".draggable-source", handle: null, delay: 100, placedTimeout: 800, plugins: [], sensors: [] };
          class M {
            constructor(h = [document.body], c = {}) {
              if (h instanceof NodeList || h instanceof Array) this.containers = [...h];
              else {
                if (!(h instanceof HTMLElement)) throw new Error("Draggable containers are expected to be of type `NodeList`, `HTMLElement[]` or `HTMLElement`");
                this.containers = [h];
              }
              this.options = r({}, g, c, { classes: r({}, n, c.classes || {}), announcements: r({}, o, c.announcements || {}) }), this.emitter = new d.default(), this.dragging = !1, this.plugins = [], this.sensors = [], this[w] = this[w].bind(this), this[C] = this[C].bind(this), this[b] = this[b].bind(this), this[f] = this[f].bind(this), document.addEventListener("drag:start", this[w], !0), document.addEventListener("drag:move", this[C], !0), document.addEventListener("drag:stop", this[b], !0), document.addEventListener("drag:pressure", this[f], !0);
              const y = Object.values(M.Plugins).map((O) => O), v = [m.MouseSensor, m.TouchSensor];
              this.addPlugin(...y, ...this.options.plugins), this.addSensor(...v, ...this.options.sensors);
              const E = new u.DraggableInitializedEvent({ draggable: this });
              this.on("mirror:created", ({ mirror: O }) => this.mirror = O), this.on("mirror:destroy", () => this.mirror = null), this.trigger(E);
            }
            destroy() {
              document.removeEventListener("drag:start", this[w], !0), document.removeEventListener("drag:move", this[C], !0), document.removeEventListener("drag:stop", this[b], !0), document.removeEventListener("drag:pressure", this[f], !0);
              const h = new u.DraggableDestroyEvent({ draggable: this });
              this.trigger(h), this.removePlugin(...this.plugins.map((c) => c.constructor)), this.removeSensor(...this.sensors.map((c) => c.constructor));
            }
            addPlugin(...h) {
              const c = h.map((y) => new y(this));
              return c.forEach((y) => y.attach()), this.plugins = [...this.plugins, ...c], this;
            }
            removePlugin(...h) {
              return this.plugins.filter((c) => h.includes(c.constructor)).forEach((c) => c.detach()), this.plugins = this.plugins.filter((c) => !h.includes(c.constructor)), this;
            }
            addSensor(...h) {
              const c = h.map((y) => new y(this.containers, this.options));
              return c.forEach((y) => y.attach()), this.sensors = [...this.sensors, ...c], this;
            }
            removeSensor(...h) {
              return this.sensors.filter((c) => h.includes(c.constructor)).forEach((c) => c.detach()), this.sensors = this.sensors.filter((c) => !h.includes(c.constructor)), this;
            }
            addContainer(...h) {
              return this.containers = [...this.containers, ...h], this.sensors.forEach((c) => c.addContainer(...h)), this;
            }
            removeContainer(...h) {
              return this.containers = this.containers.filter((c) => !h.includes(c)), this.sensors.forEach((c) => c.removeContainer(...h)), this;
            }
            on(h, ...c) {
              return this.emitter.on(h, ...c), this;
            }
            off(h, c) {
              return this.emitter.off(h, c), this;
            }
            trigger(h) {
              return this.emitter.trigger(h), this;
            }
            getClassNameFor(h) {
              return this.options.classes[h];
            }
            isDragging() {
              return !!this.dragging;
            }
            getDraggableElements() {
              return this.containers.reduce((h, c) => [...h, ...this.getDraggableElementsForContainer(c)], []);
            }
            getDraggableElementsForContainer(h) {
              return [...h.querySelectorAll(this.options.draggable)].filter((c) => c !== this.originalSource && c !== this.mirror);
            }
            [w](h) {
              const c = j(h), { target: y, container: v } = c;
              if (!this.containers.includes(v)) return;
              if (this.options.handle && y && !(0, s.closest)(y, this.options.handle) || (this.originalSource = (0, s.closest)(y, this.options.draggable), this.sourceContainer = v, !this.originalSource)) return void c.cancel();
              this.lastPlacedSource && this.lastPlacedContainer && (clearTimeout(this.placedTimeoutID), this.lastPlacedSource.classList.remove(this.getClassNameFor("source:placed")), this.lastPlacedContainer.classList.remove(this.getClassNameFor("container:placed"))), this.source = this.originalSource.cloneNode(!0), this.originalSource.parentNode.insertBefore(this.source, this.originalSource), this.originalSource.style.display = "none";
              const E = new p.DragStartEvent({ source: this.source, originalSource: this.originalSource, sourceContainer: v, sensorEvent: c });
              if (this.trigger(E), this.dragging = !E.canceled(), E.canceled()) return this.source.parentNode.removeChild(this.source), void (this.originalSource.style.display = null);
              this.originalSource.classList.add(this.getClassNameFor("source:original")), this.source.classList.add(this.getClassNameFor("source:dragging")), this.sourceContainer.classList.add(this.getClassNameFor("container:dragging")), document.body.classList.add(this.getClassNameFor("body:dragging")), A(document.body, "none"), requestAnimationFrame(() => {
                const O = j(h).clone({ target: this.source });
                this[C](r({}, h, { detail: O }));
              });
            }
            [C](h) {
              if (!this.dragging) return;
              const c = j(h), { container: y } = c;
              let v = c.target;
              const E = new p.DragMoveEvent({ source: this.source, originalSource: this.originalSource, sourceContainer: y, sensorEvent: c });
              this.trigger(E), E.canceled() && c.cancel(), v = (0, s.closest)(v, this.options.draggable);
              const O = (0, s.closest)(c.target, this.containers), L = c.overContainer || O, F = this.currentOverContainer && L !== this.currentOverContainer, N = this.currentOver && v !== this.currentOver, I = L && this.currentOverContainer !== L, k = O && v && this.currentOver !== v;
              if (N) {
                const T = new p.DragOutEvent({ source: this.source, originalSource: this.originalSource, sourceContainer: y, sensorEvent: c, over: this.currentOver });
                this.currentOver.classList.remove(this.getClassNameFor("draggable:over")), this.currentOver = null, this.trigger(T);
              }
              if (F) {
                const T = new p.DragOutContainerEvent({ source: this.source, originalSource: this.originalSource, sourceContainer: y, sensorEvent: c, overContainer: this.currentOverContainer });
                this.currentOverContainer.classList.remove(this.getClassNameFor("container:over")), this.currentOverContainer = null, this.trigger(T);
              }
              if (I) {
                L.classList.add(this.getClassNameFor("container:over"));
                const T = new p.DragOverContainerEvent({ source: this.source, originalSource: this.originalSource, sourceContainer: y, sensorEvent: c, overContainer: L });
                this.currentOverContainer = L, this.trigger(T);
              }
              if (k) {
                v.classList.add(this.getClassNameFor("draggable:over"));
                const T = new p.DragOverEvent({ source: this.source, originalSource: this.originalSource, sourceContainer: y, sensorEvent: c, overContainer: L, over: v });
                this.currentOver = v, this.trigger(T);
              }
            }
            [b](h) {
              if (!this.dragging) return;
              this.dragging = !1;
              const c = new p.DragStopEvent({ source: this.source, originalSource: this.originalSource, sensorEvent: h.sensorEvent, sourceContainer: this.sourceContainer });
              this.trigger(c), this.source.parentNode.insertBefore(this.originalSource, this.source), this.source.parentNode.removeChild(this.source), this.originalSource.style.display = "", this.source.classList.remove(this.getClassNameFor("source:dragging")), this.originalSource.classList.remove(this.getClassNameFor("source:original")), this.originalSource.classList.add(this.getClassNameFor("source:placed")), this.sourceContainer.classList.add(this.getClassNameFor("container:placed")), this.sourceContainer.classList.remove(this.getClassNameFor("container:dragging")), document.body.classList.remove(this.getClassNameFor("body:dragging")), A(document.body, ""), this.currentOver && this.currentOver.classList.remove(this.getClassNameFor("draggable:over")), this.currentOverContainer && this.currentOverContainer.classList.remove(this.getClassNameFor("container:over")), this.lastPlacedSource = this.originalSource, this.lastPlacedContainer = this.sourceContainer, this.placedTimeoutID = setTimeout(() => {
                this.lastPlacedSource && this.lastPlacedSource.classList.remove(this.getClassNameFor("source:placed")), this.lastPlacedContainer && this.lastPlacedContainer.classList.remove(this.getClassNameFor("container:placed")), this.lastPlacedSource = null, this.lastPlacedContainer = null;
              }, this.options.placedTimeout), this.source = null, this.originalSource = null, this.currentOverContainer = null, this.currentOver = null, this.sourceContainer = null;
            }
            [f](h) {
              if (!this.dragging) return;
              const c = j(h), y = this.source || (0, s.closest)(c.originalEvent.target, this.options.draggable), v = new p.DragPressureEvent({ sensorEvent: c, source: y, pressure: c.pressure });
              this.trigger(v);
            }
          }
          function j(x) {
            return x.detail;
          }
          function A(x, h) {
            x.style.webkitUserSelect = h, x.style.mozUserSelect = h, x.style.msUserSelect = h, x.style.oUserSelect = h, x.style.userSelect = h;
          }
          e.default = M, M.Plugins = { Announcement: a.Announcement, Focusable: a.Focusable, Mirror: a.Mirror, Scrollable: a.Scrollable };
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = i(1), s = (t = r) && t.__esModule ? t : { default: t }, a = i(0);
          const l = Symbol("onMouseForceWillBegin"), d = Symbol("onMouseForceDown"), m = Symbol("onMouseDown"), u = Symbol("onMouseForceChange"), p = Symbol("onMouseMove"), w = Symbol("onMouseUp"), C = Symbol("onMouseForceGlobalChange");
          class b extends s.default {
            constructor(o = [], n = {}) {
              super(o, n), this.mightDrag = !1, this[l] = this[l].bind(this), this[d] = this[d].bind(this), this[m] = this[m].bind(this), this[u] = this[u].bind(this), this[p] = this[p].bind(this), this[w] = this[w].bind(this);
            }
            attach() {
              for (const o of this.containers) o.addEventListener("webkitmouseforcewillbegin", this[l], !1), o.addEventListener("webkitmouseforcedown", this[d], !1), o.addEventListener("mousedown", this[m], !0), o.addEventListener("webkitmouseforcechanged", this[u], !1);
              document.addEventListener("mousemove", this[p]), document.addEventListener("mouseup", this[w]);
            }
            detach() {
              for (const o of this.containers) o.removeEventListener("webkitmouseforcewillbegin", this[l], !1), o.removeEventListener("webkitmouseforcedown", this[d], !1), o.removeEventListener("mousedown", this[m], !0), o.removeEventListener("webkitmouseforcechanged", this[u], !1);
              document.removeEventListener("mousemove", this[p]), document.removeEventListener("mouseup", this[w]);
            }
            [l](o) {
              o.preventDefault(), this.mightDrag = !0;
            }
            [d](o) {
              if (this.dragging) return;
              const n = document.elementFromPoint(o.clientX, o.clientY), g = o.currentTarget, M = new a.DragStartSensorEvent({ clientX: o.clientX, clientY: o.clientY, target: n, container: g, originalEvent: o });
              this.trigger(g, M), this.currentContainer = g, this.dragging = !M.canceled(), this.mightDrag = !1;
            }
            [w](o) {
              if (!this.dragging) return;
              const n = new a.DragStopSensorEvent({ clientX: o.clientX, clientY: o.clientY, target: null, container: this.currentContainer, originalEvent: o });
              this.trigger(this.currentContainer, n), this.currentContainer = null, this.dragging = !1, this.mightDrag = !1;
            }
            [m](o) {
              this.mightDrag && (o.stopPropagation(), o.stopImmediatePropagation(), o.preventDefault());
            }
            [p](o) {
              if (!this.dragging) return;
              const n = document.elementFromPoint(o.clientX, o.clientY), g = new a.DragMoveSensorEvent({ clientX: o.clientX, clientY: o.clientY, target: n, container: this.currentContainer, originalEvent: o });
              this.trigger(this.currentContainer, g);
            }
            [u](o) {
              if (this.dragging) return;
              const n = o.target, g = o.currentTarget, M = new a.DragPressureSensorEvent({ pressure: o.webkitForce, clientX: o.clientX, clientY: o.clientY, target: n, container: g, originalEvent: o });
              this.trigger(g, M);
            }
            [C](o) {
              if (!this.dragging) return;
              const n = o.target, g = new a.DragPressureSensorEvent({ pressure: o.webkitForce, clientX: o.clientX, clientY: o.clientY, target: n, container: this.currentContainer, originalEvent: o });
              this.trigger(this.currentContainer, g);
            }
          }
          e.default = b;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = i(13), s = (t = r) && t.__esModule ? t : { default: t };
          e.default = s.default;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = i(2), s = i(1), a = (t = s) && t.__esModule ? t : { default: t }, l = i(0);
          const d = Symbol("onMouseDown"), m = Symbol("onMouseUp"), u = Symbol("onDragStart"), p = Symbol("onDragOver"), w = Symbol("onDragEnd"), C = Symbol("onDrop"), b = Symbol("reset");
          class f extends a.default {
            constructor(n = [], g = {}) {
              super(n, g), this.mouseDownTimeout = null, this.draggableElement = null, this.nativeDraggableElement = null, this[d] = this[d].bind(this), this[m] = this[m].bind(this), this[u] = this[u].bind(this), this[p] = this[p].bind(this), this[w] = this[w].bind(this), this[C] = this[C].bind(this);
            }
            attach() {
              document.addEventListener("mousedown", this[d], !0);
            }
            detach() {
              document.removeEventListener("mousedown", this[d], !0);
            }
            [u](n) {
              n.dataTransfer.setData("text", ""), n.dataTransfer.effectAllowed = this.options.type;
              const g = document.elementFromPoint(n.clientX, n.clientY);
              if (this.currentContainer = (0, r.closest)(n.target, this.containers), !this.currentContainer) return;
              const M = new l.DragStartSensorEvent({ clientX: n.clientX, clientY: n.clientY, target: g, container: this.currentContainer, originalEvent: n });
              setTimeout(() => {
                this.trigger(this.currentContainer, M), M.canceled() ? this.dragging = !1 : this.dragging = !0;
              }, 0);
            }
            [p](n) {
              if (!this.dragging) return;
              const g = document.elementFromPoint(n.clientX, n.clientY), M = this.currentContainer, j = new l.DragMoveSensorEvent({ clientX: n.clientX, clientY: n.clientY, target: g, container: M, originalEvent: n });
              this.trigger(M, j), j.canceled() || (n.preventDefault(), n.dataTransfer.dropEffect = this.options.type);
            }
            [w](n) {
              if (!this.dragging) return;
              document.removeEventListener("mouseup", this[m], !0);
              const g = document.elementFromPoint(n.clientX, n.clientY), M = this.currentContainer, j = new l.DragStopSensorEvent({ clientX: n.clientX, clientY: n.clientY, target: g, container: M, originalEvent: n });
              this.trigger(M, j), this.dragging = !1, this[b]();
            }
            [C](n) {
              n.preventDefault();
            }
            [d](n) {
              if (n.target && (n.target.form || n.target.contenteditable)) return;
              const g = (0, r.closest)(n.target, (j) => j.draggable);
              g && (g.draggable = !1, this.nativeDraggableElement = g), document.addEventListener("mouseup", this[m], !0), document.addEventListener("dragstart", this[u], !1), document.addEventListener("dragover", this[p], !1), document.addEventListener("dragend", this[w], !1), document.addEventListener("drop", this[C], !1);
              const M = (0, r.closest)(n.target, this.options.draggable);
              M && (this.mouseDownTimeout = setTimeout(() => {
                M.draggable = !0, this.draggableElement = M;
              }, this.options.delay));
            }
            [m]() {
              this[b]();
            }
            [b]() {
              clearTimeout(this.mouseDownTimeout), document.removeEventListener("mouseup", this[m], !0), document.removeEventListener("dragstart", this[u], !1), document.removeEventListener("dragover", this[p], !1), document.removeEventListener("dragend", this[w], !1), document.removeEventListener("drop", this[C], !1), this.nativeDraggableElement && (this.nativeDraggableElement.draggable = !0, this.nativeDraggableElement = null), this.draggableElement && (this.draggableElement.draggable = !1, this.draggableElement = null);
            }
          }
          e.default = f;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = i(15), s = (t = r) && t.__esModule ? t : { default: t };
          e.default = s.default;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = i(2), s = i(1), a = (t = s) && t.__esModule ? t : { default: t }, l = i(0);
          const d = Symbol("onTouchStart"), m = Symbol("onTouchHold"), u = Symbol("onTouchEnd"), p = Symbol("onTouchMove");
          let w = !1;
          window.addEventListener("touchmove", (f) => {
            w && f.preventDefault();
          }, { passive: !1 });
          class C extends a.default {
            constructor(o = [], n = {}) {
              super(o, n), this.currentScrollableParent = null, this.tapTimeout = null, this.touchMoved = !1, this[d] = this[d].bind(this), this[m] = this[m].bind(this), this[u] = this[u].bind(this), this[p] = this[p].bind(this);
            }
            attach() {
              document.addEventListener("touchstart", this[d]);
            }
            detach() {
              document.removeEventListener("touchstart", this[d]);
            }
            [d](o) {
              const n = (0, r.closest)(o.target, this.containers);
              n && (document.addEventListener("touchmove", this[p]), document.addEventListener("touchend", this[u]), document.addEventListener("touchcancel", this[u]), n.addEventListener("contextmenu", b), this.currentContainer = n, this.tapTimeout = setTimeout(this[m](o, n), this.options.delay));
            }
            [m](o, n) {
              return () => {
                if (this.touchMoved) return;
                const g = o.touches[0] || o.changedTouches[0], M = o.target, j = new l.DragStartSensorEvent({ clientX: g.pageX, clientY: g.pageY, target: M, container: n, originalEvent: o });
                this.trigger(n, j), this.dragging = !j.canceled(), w = this.dragging;
              };
            }
            [p](o) {
              if (this.touchMoved = !0, !this.dragging) return;
              const n = o.touches[0] || o.changedTouches[0], g = document.elementFromPoint(n.pageX - window.scrollX, n.pageY - window.scrollY), M = new l.DragMoveSensorEvent({ clientX: n.pageX, clientY: n.pageY, target: g, container: this.currentContainer, originalEvent: o });
              this.trigger(this.currentContainer, M);
            }
            [u](o) {
              if (this.touchMoved = !1, w = !1, document.removeEventListener("touchend", this[u]), document.removeEventListener("touchcancel", this[u]), document.removeEventListener("touchmove", this[p]), this.currentContainer && this.currentContainer.removeEventListener("contextmenu", b), clearTimeout(this.tapTimeout), !this.dragging) return;
              const n = o.touches[0] || o.changedTouches[0], g = document.elementFromPoint(n.pageX - window.scrollX, n.pageY - window.scrollY);
              o.preventDefault();
              const M = new l.DragStopSensorEvent({ clientX: n.pageX, clientY: n.pageY, target: g, container: this.currentContainer, originalEvent: o });
              this.trigger(this.currentContainer, M), this.currentContainer = null, this.dragging = !1;
            }
          }
          function b(f) {
            f.preventDefault(), f.stopPropagation();
          }
          e.default = C;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = i(17), s = (t = r) && t.__esModule ? t : { default: t };
          e.default = s.default;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 }), e.DragPressureSensorEvent = e.DragStopSensorEvent = e.DragMoveSensorEvent = e.DragStartSensorEvent = e.SensorEvent = void 0;
          var t, r = i(3), s = (t = r) && t.__esModule ? t : { default: t };
          class a extends s.default {
            get originalEvent() {
              return this.data.originalEvent;
            }
            get clientX() {
              return this.data.clientX;
            }
            get clientY() {
              return this.data.clientY;
            }
            get target() {
              return this.data.target;
            }
            get container() {
              return this.data.container;
            }
            get pressure() {
              return this.data.pressure;
            }
          }
          e.SensorEvent = a;
          class l extends a {
          }
          e.DragStartSensorEvent = l, l.type = "drag:start";
          class d extends a {
          }
          e.DragMoveSensorEvent = d, d.type = "drag:move";
          class m extends a {
          }
          e.DragStopSensorEvent = m, m.type = "drag:stop";
          class u extends a {
          }
          e.DragPressureSensorEvent = u, u.type = "drag:pressure";
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = i(2), s = i(1), a = (t = s) && t.__esModule ? t : { default: t }, l = i(0);
          const d = Symbol("onContextMenuWhileDragging"), m = Symbol("onMouseDown"), u = Symbol("onMouseMove"), p = Symbol("onMouseUp");
          class w extends a.default {
            constructor(f = [], o = {}) {
              super(f, o), this.mouseDown = !1, this.mouseDownTimeout = null, this.openedContextMenu = !1, this[d] = this[d].bind(this), this[m] = this[m].bind(this), this[u] = this[u].bind(this), this[p] = this[p].bind(this);
            }
            attach() {
              document.addEventListener("mousedown", this[m], !0);
            }
            detach() {
              document.removeEventListener("mousedown", this[m], !0);
            }
            [m](f) {
              if (f.button !== 0 || f.ctrlKey || f.metaKey) return;
              document.addEventListener("mouseup", this[p]);
              const o = document.elementFromPoint(f.clientX, f.clientY), n = (0, r.closest)(o, this.containers);
              n && (document.addEventListener("dragstart", C), this.mouseDown = !0, clearTimeout(this.mouseDownTimeout), this.mouseDownTimeout = setTimeout(() => {
                if (!this.mouseDown) return;
                const g = new l.DragStartSensorEvent({ clientX: f.clientX, clientY: f.clientY, target: o, container: n, originalEvent: f });
                this.trigger(n, g), this.currentContainer = n, this.dragging = !g.canceled(), this.dragging && (document.addEventListener("contextmenu", this[d]), document.addEventListener("mousemove", this[u]));
              }, this.options.delay));
            }
            [u](f) {
              if (!this.dragging) return;
              const o = document.elementFromPoint(f.clientX, f.clientY), n = new l.DragMoveSensorEvent({ clientX: f.clientX, clientY: f.clientY, target: o, container: this.currentContainer, originalEvent: f });
              this.trigger(this.currentContainer, n);
            }
            [p](f) {
              if (this.mouseDown = !!this.openedContextMenu, this.openedContextMenu) return void (this.openedContextMenu = !1);
              if (document.removeEventListener("mouseup", this[p]), document.removeEventListener("dragstart", C), !this.dragging) return;
              const o = document.elementFromPoint(f.clientX, f.clientY), n = new l.DragStopSensorEvent({ clientX: f.clientX, clientY: f.clientY, target: o, container: this.currentContainer, originalEvent: f });
              this.trigger(this.currentContainer, n), document.removeEventListener("contextmenu", this[d]), document.removeEventListener("mousemove", this[u]), this.currentContainer = null, this.dragging = !1;
            }
            [d](f) {
              f.preventDefault(), this.openedContextMenu = !0;
            }
          }
          function C(b) {
            b.preventDefault();
          }
          e.default = w;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = i(20), s = (t = r) && t.__esModule ? t : { default: t };
          e.default = s.default;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t = Object.assign || function(r) {
            for (var s = 1; s < arguments.length; s++) {
              var a = arguments[s];
              for (var l in a) Object.prototype.hasOwnProperty.call(a, l) && (r[l] = a[l]);
            }
            return r;
          };
          e.default = class {
            constructor(r = [], s = {}) {
              this.containers = [...r], this.options = t({}, s), this.dragging = !1, this.currentContainer = null;
            }
            attach() {
              return this;
            }
            detach() {
              return this;
            }
            addContainer(...r) {
              this.containers = [...this.containers, ...r];
            }
            removeContainer(...r) {
              this.containers = this.containers.filter((s) => !r.includes(s));
            }
            trigger(r, s) {
              const a = document.createEvent("Event");
              return a.detail = s, a.initEvent(s.type, !0, !0), r.dispatchEvent(a), this.lastEvent = s, s;
            }
          };
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 }), e.default = function(t) {
            return requestAnimationFrame(() => {
              requestAnimationFrame(t);
            });
          };
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = i(23), s = (t = r) && t.__esModule ? t : { default: t };
          e.default = s.default;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 }), e.default = function(r, s) {
            if (!r) return null;
            const a = s, l = s, d = s, m = s, u = typeof s == "string", p = typeof s == "function", w = s instanceof NodeList || s instanceof Array, C = s instanceof HTMLElement;
            let b = r;
            do {
              if (b = b.correspondingUseElement || b.correspondingElement || b, (f = b) ? u ? t.call(f, a) : w ? [...d].includes(f) : C ? m === f : p && l(f) : f) return b;
              b = b.parentNode;
            } while (b && b !== document.body && b !== document);
            var f;
            return null;
          };
          const t = Element.prototype.matches || Element.prototype.webkitMatchesSelector || Element.prototype.mozMatchesSelector || Element.prototype.msMatchesSelector;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = i(25), s = (t = r) && t.__esModule ? t : { default: t };
          e.default = s.default;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 }), e.defaultOptions = e.scroll = e.onDragStop = e.onDragMove = e.onDragStart = void 0;
          var t, r = Object.assign || function(f) {
            for (var o = 1; o < arguments.length; o++) {
              var n = arguments[o];
              for (var g in n) Object.prototype.hasOwnProperty.call(n, g) && (f[g] = n[g]);
            }
            return f;
          }, s = i(4), a = (t = s) && t.__esModule ? t : { default: t }, l = i(2);
          const d = e.onDragStart = Symbol("onDragStart"), m = e.onDragMove = Symbol("onDragMove"), u = e.onDragStop = Symbol("onDragStop"), p = e.scroll = Symbol("scroll"), w = e.defaultOptions = { speed: 6, sensitivity: 50, scrollableElements: [] };
          class C extends a.default {
            constructor(o) {
              super(o), this.options = r({}, w, this.getOptions()), this.currentMousePosition = null, this.scrollAnimationFrame = null, this.scrollableElement = null, this.findScrollableElementFrame = null, this[d] = this[d].bind(this), this[m] = this[m].bind(this), this[u] = this[u].bind(this), this[p] = this[p].bind(this);
            }
            attach() {
              this.draggable.on("drag:start", this[d]).on("drag:move", this[m]).on("drag:stop", this[u]);
            }
            detach() {
              this.draggable.off("drag:start", this[d]).off("drag:move", this[m]).off("drag:stop", this[u]);
            }
            getOptions() {
              return this.draggable.options.scrollable || {};
            }
            getScrollableElement(o) {
              return this.hasDefinedScrollableElements() ? (0, l.closest)(o, this.options.scrollableElements) || document.documentElement : (function(n) {
                if (!n) return b();
                const g = getComputedStyle(n).getPropertyValue("position"), M = g === "absolute", j = (0, l.closest)(n, (A) => (!M || !(function(x) {
                  return getComputedStyle(x).getPropertyValue("position") === "static";
                })(A)) && (function(x) {
                  const h = getComputedStyle(x, null), c = h.getPropertyValue("overflow") + h.getPropertyValue("overflow-y") + h.getPropertyValue("overflow-x");
                  return /(auto|scroll)/.test(c);
                })(A));
                return g !== "fixed" && j ? j : b();
              })(o);
            }
            hasDefinedScrollableElements() {
              return this.options.scrollableElements.length !== 0;
            }
            [d](o) {
              this.findScrollableElementFrame = requestAnimationFrame(() => {
                this.scrollableElement = this.getScrollableElement(o.source);
              });
            }
            [m](o) {
              if (this.findScrollableElementFrame = requestAnimationFrame(() => {
                this.scrollableElement = this.getScrollableElement(o.sensorEvent.target);
              }), !this.scrollableElement) return;
              const n = o.sensorEvent, g = { x: 0, y: 0 };
              "ontouchstart" in window && (g.y = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0, g.x = window.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft || 0), this.currentMousePosition = { clientX: n.clientX - g.x, clientY: n.clientY - g.y }, this.scrollAnimationFrame = requestAnimationFrame(this[p]);
            }
            [u]() {
              cancelAnimationFrame(this.scrollAnimationFrame), cancelAnimationFrame(this.findScrollableElementFrame), this.scrollableElement = null, this.scrollAnimationFrame = null, this.findScrollableElementFrame = null, this.currentMousePosition = null;
            }
            [p]() {
              if (!this.scrollableElement || !this.currentMousePosition) return;
              cancelAnimationFrame(this.scrollAnimationFrame);
              const { speed: o, sensitivity: n } = this.options, g = this.scrollableElement.getBoundingClientRect(), M = g.bottom > window.innerHeight, j = g.top < 0 || M, A = b(), x = this.scrollableElement, h = this.currentMousePosition.clientX, c = this.currentMousePosition.clientY;
              if (x === document.body || x === document.documentElement || j) {
                const { innerHeight: y, innerWidth: v } = window;
                c < n ? A.scrollTop -= o : y - c < n && (A.scrollTop += o), h < n ? A.scrollLeft -= o : v - h < n && (A.scrollLeft += o);
              } else {
                const { offsetHeight: y, offsetWidth: v } = x;
                g.top + y - c < n ? x.scrollTop += o : c - g.top < n && (x.scrollTop -= o), g.left + v - h < n ? x.scrollLeft += o : h - g.left < n && (x.scrollLeft -= o);
              }
              this.scrollAnimationFrame = requestAnimationFrame(this[p]);
            }
          }
          function b() {
            return document.scrollingElement || document.documentElement;
          }
          e.default = C;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 }), e.defaultOptions = void 0;
          var t, r = i(27), s = (t = r) && t.__esModule ? t : { default: t };
          e.default = s.default, e.defaultOptions = r.defaultOptions;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 }), e.MirrorDestroyEvent = e.MirrorMoveEvent = e.MirrorAttachedEvent = e.MirrorCreatedEvent = e.MirrorCreateEvent = e.MirrorEvent = void 0;
          var t, r = i(3), s = (t = r) && t.__esModule ? t : { default: t };
          class a extends s.default {
            get source() {
              return this.data.source;
            }
            get originalSource() {
              return this.data.originalSource;
            }
            get sourceContainer() {
              return this.data.sourceContainer;
            }
            get sensorEvent() {
              return this.data.sensorEvent;
            }
            get dragEvent() {
              return this.data.dragEvent;
            }
            get originalEvent() {
              return this.sensorEvent ? this.sensorEvent.originalEvent : null;
            }
          }
          e.MirrorEvent = a;
          class l extends a {
          }
          e.MirrorCreateEvent = l, l.type = "mirror:create";
          class d extends a {
            get mirror() {
              return this.data.mirror;
            }
          }
          e.MirrorCreatedEvent = d, d.type = "mirror:created";
          class m extends a {
            get mirror() {
              return this.data.mirror;
            }
          }
          e.MirrorAttachedEvent = m, m.type = "mirror:attached";
          class u extends a {
            get mirror() {
              return this.data.mirror;
            }
          }
          e.MirrorMoveEvent = u, u.type = "mirror:move", u.cancelable = !0;
          class p extends a {
            get mirror() {
              return this.data.mirror;
            }
          }
          e.MirrorDestroyEvent = p, p.type = "mirror:destroy", p.cancelable = !0;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t = i(29);
          Object.keys(t).forEach((function(r) {
            r !== "default" && r !== "__esModule" && Object.defineProperty(e, r, { enumerable: !0, get: function() {
              return t[r];
            } });
          }));
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 }), e.defaultOptions = e.getAppendableContainer = e.onScroll = e.onMirrorMove = e.onMirrorCreated = e.onDragStop = e.onDragMove = e.onDragStart = void 0;
          var t, r = Object.assign || function(y) {
            for (var v = 1; v < arguments.length; v++) {
              var E = arguments[v];
              for (var O in E) Object.prototype.hasOwnProperty.call(E, O) && (y[O] = E[O]);
            }
            return y;
          }, s = i(4), a = (t = s) && t.__esModule ? t : { default: t }, l = i(30);
          function d(y, v) {
            var E = {};
            for (var O in y) v.indexOf(O) >= 0 || Object.prototype.hasOwnProperty.call(y, O) && (E[O] = y[O]);
            return E;
          }
          const m = e.onDragStart = Symbol("onDragStart"), u = e.onDragMove = Symbol("onDragMove"), p = e.onDragStop = Symbol("onDragStop"), w = e.onMirrorCreated = Symbol("onMirrorCreated"), C = e.onMirrorMove = Symbol("onMirrorMove"), b = e.onScroll = Symbol("onScroll"), f = e.getAppendableContainer = Symbol("getAppendableContainer"), o = e.defaultOptions = { constrainDimensions: !1, xAxis: !0, yAxis: !0, cursorOffsetX: null, cursorOffsetY: null };
          class n extends a.default {
            constructor(v) {
              super(v), this.options = r({}, o, this.getOptions()), this.scrollOffset = { x: 0, y: 0 }, this.initialScrollOffset = { x: window.scrollX, y: window.scrollY }, this[m] = this[m].bind(this), this[u] = this[u].bind(this), this[p] = this[p].bind(this), this[w] = this[w].bind(this), this[C] = this[C].bind(this), this[b] = this[b].bind(this);
            }
            attach() {
              this.draggable.on("drag:start", this[m]).on("drag:move", this[u]).on("drag:stop", this[p]).on("mirror:created", this[w]).on("mirror:move", this[C]);
            }
            detach() {
              this.draggable.off("drag:start", this[m]).off("drag:move", this[u]).off("drag:stop", this[p]).off("mirror:created", this[w]).off("mirror:move", this[C]);
            }
            getOptions() {
              return this.draggable.options.mirror || {};
            }
            [m](v) {
              if (v.canceled()) return;
              "ontouchstart" in window && document.addEventListener("scroll", this[b], !0), this.initialScrollOffset = { x: window.scrollX, y: window.scrollY };
              const { source: E, originalSource: O, sourceContainer: L, sensorEvent: F } = v, N = new l.MirrorCreateEvent({ source: E, originalSource: O, sourceContainer: L, sensorEvent: F, dragEvent: v });
              if (this.draggable.trigger(N), (function($) {
                return /^drag/.test($.originalEvent.type);
              })(F) || N.canceled()) return;
              const I = this[f](E) || L;
              this.mirror = E.cloneNode(!0);
              const k = new l.MirrorCreatedEvent({ source: E, originalSource: O, sourceContainer: L, sensorEvent: F, dragEvent: v, mirror: this.mirror }), T = new l.MirrorAttachedEvent({ source: E, originalSource: O, sourceContainer: L, sensorEvent: F, dragEvent: v, mirror: this.mirror });
              this.draggable.trigger(k), I.appendChild(this.mirror), this.draggable.trigger(T);
            }
            [u](v) {
              if (!this.mirror || v.canceled()) return;
              const { source: E, originalSource: O, sourceContainer: L, sensorEvent: F } = v, N = new l.MirrorMoveEvent({ source: E, originalSource: O, sourceContainer: L, sensorEvent: F, dragEvent: v, mirror: this.mirror });
              this.draggable.trigger(N);
            }
            [p](v) {
              if ("ontouchstart" in window && document.removeEventListener("scroll", this[b], !0), this.initialScrollOffset = { x: 0, y: 0 }, this.scrollOffset = { x: 0, y: 0 }, !this.mirror) return;
              const { source: E, sourceContainer: O, sensorEvent: L } = v, F = new l.MirrorDestroyEvent({ source: E, mirror: this.mirror, sourceContainer: O, sensorEvent: L, dragEvent: v });
              this.draggable.trigger(F), F.canceled() || this.mirror.parentNode.removeChild(this.mirror);
            }
            [b]() {
              this.scrollOffset = { x: window.scrollX - this.initialScrollOffset.x, y: window.scrollY - this.initialScrollOffset.y };
            }
            [w]({ mirror: v, source: E, sensorEvent: O }) {
              const L = { mirror: v, source: E, sensorEvent: O, mirrorClass: this.draggable.getClassNameFor("mirror"), scrollOffset: this.scrollOffset, options: this.options };
              return Promise.resolve(L).then(g).then(M).then(j).then(A).then(h({ initial: !0 })).then(x).then((F) => {
                let { mirrorOffset: N, initialX: I, initialY: k } = F, T = d(F, ["mirrorOffset", "initialX", "initialY"]);
                return this.mirrorOffset = N, this.initialX = I, this.initialY = k, r({ mirrorOffset: N, initialX: I, initialY: k }, T);
              });
            }
            [C](v) {
              if (v.canceled()) return null;
              const E = { mirror: v.mirror, sensorEvent: v.sensorEvent, mirrorOffset: this.mirrorOffset, options: this.options, initialX: this.initialX, initialY: this.initialY, scrollOffset: this.scrollOffset };
              return Promise.resolve(E).then(h({}));
            }
            [f](v) {
              const E = this.options.appendTo;
              return typeof E == "string" ? document.querySelector(E) : E instanceof HTMLElement ? E : typeof E == "function" ? E(v) : v.parentNode;
            }
          }
          function g(y) {
            let { source: v } = y, E = d(y, ["source"]);
            return c((O) => {
              const L = v.getBoundingClientRect();
              O(r({ source: v, sourceRect: L }, E));
            });
          }
          function M(y) {
            let { sensorEvent: v, sourceRect: E, options: O } = y, L = d(y, ["sensorEvent", "sourceRect", "options"]);
            return c((F) => {
              const N = O.cursorOffsetY === null ? v.clientY - E.top : O.cursorOffsetY, I = O.cursorOffsetX === null ? v.clientX - E.left : O.cursorOffsetX;
              F(r({ sensorEvent: v, sourceRect: E, mirrorOffset: { top: N, left: I }, options: O }, L));
            });
          }
          function j(y) {
            let { mirror: v, source: E, options: O } = y, L = d(y, ["mirror", "source", "options"]);
            return c((F) => {
              let N, I;
              if (O.constrainDimensions) {
                const k = getComputedStyle(E);
                N = k.getPropertyValue("height"), I = k.getPropertyValue("width");
              }
              v.style.position = "fixed", v.style.pointerEvents = "none", v.style.top = 0, v.style.left = 0, v.style.margin = 0, O.constrainDimensions && (v.style.height = N, v.style.width = I), F(r({ mirror: v, source: E, options: O }, L));
            });
          }
          function A(y) {
            let { mirror: v, mirrorClass: E } = y, O = d(y, ["mirror", "mirrorClass"]);
            return c((L) => {
              v.classList.add(E), L(r({ mirror: v, mirrorClass: E }, O));
            });
          }
          function x(y) {
            let { mirror: v } = y, E = d(y, ["mirror"]);
            return c((O) => {
              v.removeAttribute("id"), delete v.id, O(r({ mirror: v }, E));
            });
          }
          function h({ withFrame: y = !1, initial: v = !1 } = {}) {
            return (E) => {
              let { mirror: O, sensorEvent: L, mirrorOffset: F, initialY: N, initialX: I, scrollOffset: k, options: T } = E, $ = d(E, ["mirror", "sensorEvent", "mirrorOffset", "initialY", "initialX", "scrollOffset", "options"]);
              return c((W) => {
                const q = r({ mirror: O, sensorEvent: L, mirrorOffset: F, options: T }, $);
                if (F) {
                  const B = L.clientX - F.left - k.x, U = L.clientY - F.top - k.y;
                  T.xAxis && T.yAxis || v ? O.style.transform = `translate3d(${B}px, ${U}px, 0)` : T.xAxis && !T.yAxis ? O.style.transform = `translate3d(${B}px, ${N}px, 0)` : T.yAxis && !T.xAxis && (O.style.transform = `translate3d(${I}px, ${U}px, 0)`), v && (q.initialX = B, q.initialY = U);
                }
                W(q);
              }, {});
            };
          }
          function c(y, { raf: v = !1 } = {}) {
            return new Promise((E, O) => {
              v ? requestAnimationFrame(() => {
                y(E, O);
              }) : y(E, O);
            });
          }
          e.default = n;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 }), e.defaultOptions = void 0;
          var t, r = i(31), s = (t = r) && t.__esModule ? t : { default: t };
          e.default = s.default, e.defaultOptions = r.defaultOptions;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = Object.assign || function(w) {
            for (var C = 1; C < arguments.length; C++) {
              var b = arguments[C];
              for (var f in b) Object.prototype.hasOwnProperty.call(b, f) && (w[f] = b[f]);
            }
            return w;
          }, s = i(4), a = (t = s) && t.__esModule ? t : { default: t };
          const l = Symbol("onInitialize"), d = Symbol("onDestroy"), m = {};
          class u extends a.default {
            constructor(C) {
              super(C), this.options = r({}, m, this.getOptions()), this[l] = this[l].bind(this), this[d] = this[d].bind(this);
            }
            attach() {
              this.draggable.on("draggable:initialize", this[l]).on("draggable:destroy", this[d]);
            }
            detach() {
              this.draggable.off("draggable:initialize", this[l]).off("draggable:destroy", this[d]);
            }
            getOptions() {
              return this.draggable.options.focusable || {};
            }
            getElements() {
              return [...this.draggable.containers, ...this.draggable.getDraggableElements()];
            }
            [l]() {
              requestAnimationFrame(() => {
                this.getElements().forEach((C) => (function(b) {
                  !b.getAttribute("tabindex") && b.tabIndex === -1 && (p.push(b), b.tabIndex = 0);
                })(C));
              });
            }
            [d]() {
              requestAnimationFrame(() => {
                this.getElements().forEach((C) => (function(b) {
                  const f = p.indexOf(b);
                  f !== -1 && (b.tabIndex = -1, p.splice(f, 1));
                })(C));
              });
            }
          }
          e.default = u;
          const p = [];
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = i(33), s = (t = r) && t.__esModule ? t : { default: t };
          e.default = s.default;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 }), e.default = class {
            constructor(t) {
              this.draggable = t;
            }
            attach() {
              throw new Error("Not Implemented");
            }
            detach() {
              throw new Error("Not Implemented");
            }
          };
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 }), e.defaultOptions = void 0;
          var t, r = Object.assign || function(b) {
            for (var f = 1; f < arguments.length; f++) {
              var o = arguments[f];
              for (var n in o) Object.prototype.hasOwnProperty.call(o, n) && (b[n] = o[n]);
            }
            return b;
          }, s = i(4), a = (t = s) && t.__esModule ? t : { default: t };
          const l = Symbol("onInitialize"), d = Symbol("onDestroy"), m = Symbol("announceEvent"), u = Symbol("announceMessage"), p = e.defaultOptions = { expire: 7e3 };
          class w extends a.default {
            constructor(f) {
              super(f), this.options = r({}, p, this.getOptions()), this.originalTriggerMethod = this.draggable.trigger, this[l] = this[l].bind(this), this[d] = this[d].bind(this);
            }
            attach() {
              this.draggable.on("draggable:initialize", this[l]);
            }
            detach() {
              this.draggable.off("draggable:destroy", this[d]);
            }
            getOptions() {
              return this.draggable.options.announcements || {};
            }
            [m](f) {
              const o = this.options[f.type];
              o && typeof o == "string" && this[u](o), o && typeof o == "function" && this[u](o(f));
            }
            [u](f) {
              (function(o, { expire: n }) {
                const g = document.createElement("div");
                g.textContent = o, C.appendChild(g), setTimeout(() => {
                  C.removeChild(g);
                }, n);
              })(f, { expire: this.options.expire });
            }
            [l]() {
              this.draggable.trigger = (f) => {
                try {
                  this[m](f);
                } finally {
                  this.originalTriggerMethod.call(this.draggable, f);
                }
              };
            }
            [d]() {
              this.draggable.trigger = this.originalTriggerMethod;
            }
          }
          e.default = w;
          const C = (function() {
            const b = document.createElement("div");
            return b.setAttribute("id", "draggable-live-region"), b.setAttribute("aria-relevant", "additions"), b.setAttribute("aria-atomic", "true"), b.setAttribute("aria-live", "assertive"), b.setAttribute("role", "log"), b.style.position = "fixed", b.style.width = "1px", b.style.height = "1px", b.style.top = "-1px", b.style.overflow = "hidden", b;
          })();
          document.addEventListener("DOMContentLoaded", () => {
            document.body.appendChild(C);
          });
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 }), e.defaultOptions = void 0;
          var t, r = i(36), s = (t = r) && t.__esModule ? t : { default: t };
          e.default = s.default, e.defaultOptions = r.defaultOptions;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 }), e.DraggableDestroyEvent = e.DraggableInitializedEvent = e.DraggableEvent = void 0;
          var t, r = i(3), s = (t = r) && t.__esModule ? t : { default: t };
          class a extends s.default {
            get draggable() {
              return this.data.draggable;
            }
          }
          e.DraggableEvent = a, a.type = "draggable";
          class l extends a {
          }
          e.DraggableInitializedEvent = l, l.type = "draggable:initialize";
          class d extends a {
          }
          e.DraggableDestroyEvent = d, d.type = "draggable:destroy";
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 }), e.DragStopEvent = e.DragPressureEvent = e.DragOutContainerEvent = e.DragOverContainerEvent = e.DragOutEvent = e.DragOverEvent = e.DragMoveEvent = e.DragStartEvent = e.DragEvent = void 0;
          var t, r = i(3), s = (t = r) && t.__esModule ? t : { default: t };
          class a extends s.default {
            get source() {
              return this.data.source;
            }
            get originalSource() {
              return this.data.originalSource;
            }
            get mirror() {
              return this.data.mirror;
            }
            get sourceContainer() {
              return this.data.sourceContainer;
            }
            get sensorEvent() {
              return this.data.sensorEvent;
            }
            get originalEvent() {
              return this.sensorEvent ? this.sensorEvent.originalEvent : null;
            }
          }
          e.DragEvent = a, a.type = "drag";
          class l extends a {
          }
          e.DragStartEvent = l, l.type = "drag:start", l.cancelable = !0;
          class d extends a {
          }
          e.DragMoveEvent = d, d.type = "drag:move";
          class m extends a {
            get overContainer() {
              return this.data.overContainer;
            }
            get over() {
              return this.data.over;
            }
          }
          e.DragOverEvent = m, m.type = "drag:over", m.cancelable = !0;
          class u extends a {
            get overContainer() {
              return this.data.overContainer;
            }
            get over() {
              return this.data.over;
            }
          }
          e.DragOutEvent = u, u.type = "drag:out";
          class p extends a {
            get overContainer() {
              return this.data.overContainer;
            }
          }
          e.DragOverContainerEvent = p, p.type = "drag:over:container";
          class w extends a {
            get overContainer() {
              return this.data.overContainer;
            }
          }
          e.DragOutContainerEvent = w, w.type = "drag:out:container";
          class C extends a {
            get pressure() {
              return this.data.pressure;
            }
          }
          e.DragPressureEvent = C, C.type = "drag:pressure";
          class b extends a {
          }
          e.DragStopEvent = b, b.type = "drag:stop";
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t = i(8);
          Object.keys(t).forEach((function(u) {
            u !== "default" && u !== "__esModule" && Object.defineProperty(e, u, { enumerable: !0, get: function() {
              return t[u];
            } });
          }));
          var r = i(7);
          Object.keys(r).forEach((function(u) {
            u !== "default" && u !== "__esModule" && Object.defineProperty(e, u, { enumerable: !0, get: function() {
              return r[u];
            } });
          }));
          var s = i(6);
          Object.keys(s).forEach((function(u) {
            u !== "default" && u !== "__esModule" && Object.defineProperty(e, u, { enumerable: !0, get: function() {
              return s[u];
            } });
          }));
          var a = i(5);
          Object.keys(a).forEach((function(u) {
            u !== "default" && u !== "__esModule" && Object.defineProperty(e, u, { enumerable: !0, get: function() {
              return a[u];
            } });
          }));
          var l, d = i(12), m = (l = d) && l.__esModule ? l : { default: l };
          e.default = m.default;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t, r = Object.assign || function(o) {
            for (var n = 1; n < arguments.length; n++) {
              var g = arguments[n];
              for (var M in g) Object.prototype.hasOwnProperty.call(g, M) && (o[M] = g[M]);
            }
            return o;
          }, s = i(40), a = (t = s) && t.__esModule ? t : { default: t }, l = i(9);
          const d = Symbol("onDragStart"), m = Symbol("onDragOverContainer"), u = Symbol("onDragOver"), p = Symbol("onDragStop"), w = { "sortable:sorted": function({ dragEvent: o }) {
            const n = o.source.textContent.trim() || o.source.id || "sortable element";
            if (o.over) {
              const g = o.over.textContent.trim() || o.over.id || "sortable element";
              return o.source.compareDocumentPosition(o.over) & Node.DOCUMENT_POSITION_FOLLOWING ? `Placed ${n} after ${g}` : `Placed ${n} before ${g}`;
            }
            return `Placed ${n} into a different container`;
          } };
          class C extends a.default {
            constructor(n = [], g = {}) {
              super(n, r({}, g, { announcements: r({}, w, g.announcements || {}) })), this.startIndex = null, this.startContainer = null, this[d] = this[d].bind(this), this[m] = this[m].bind(this), this[u] = this[u].bind(this), this[p] = this[p].bind(this), this.on("drag:start", this[d]).on("drag:over:container", this[m]).on("drag:over", this[u]).on("drag:stop", this[p]);
            }
            destroy() {
              super.destroy(), this.off("drag:start", this[d]).off("drag:over:container", this[m]).off("drag:over", this[u]).off("drag:stop", this[p]);
            }
            index(n) {
              return this.getDraggableElementsForContainer(n.parentNode).indexOf(n);
            }
            [d](n) {
              this.startContainer = n.source.parentNode, this.startIndex = this.index(n.source);
              const g = new l.SortableStartEvent({ dragEvent: n, startIndex: this.startIndex, startContainer: this.startContainer });
              this.trigger(g), g.canceled() && n.cancel();
            }
            [m](n) {
              if (n.canceled()) return;
              const { source: g, over: M, overContainer: j } = n, A = this.index(g), x = new l.SortableSortEvent({ dragEvent: n, currentIndex: A, source: g, over: M });
              if (this.trigger(x), x.canceled()) return;
              const h = f({ source: g, over: M, overContainer: j, children: this.getDraggableElementsForContainer(j) });
              if (!h) return;
              const { oldContainer: c, newContainer: y } = h, v = this.index(n.source), E = new l.SortableSortedEvent({ dragEvent: n, oldIndex: A, newIndex: v, oldContainer: c, newContainer: y });
              this.trigger(E);
            }
            [u](n) {
              if (n.over === n.originalSource || n.over === n.source) return;
              const { source: g, over: M, overContainer: j } = n, A = this.index(g), x = new l.SortableSortEvent({ dragEvent: n, currentIndex: A, source: g, over: M });
              if (this.trigger(x), x.canceled()) return;
              const h = f({ source: g, over: M, overContainer: j, children: this.getDraggableElementsForContainer(j) });
              if (!h) return;
              const { oldContainer: c, newContainer: y } = h, v = this.index(g), E = new l.SortableSortedEvent({ dragEvent: n, oldIndex: A, newIndex: v, oldContainer: c, newContainer: y });
              this.trigger(E);
            }
            [p](n) {
              const g = new l.SortableStopEvent({ dragEvent: n, oldIndex: this.startIndex, newIndex: this.index(n.source), oldContainer: this.startContainer, newContainer: n.source.parentNode });
              this.trigger(g), this.startIndex = null, this.startContainer = null;
            }
          }
          function b(o) {
            return Array.prototype.indexOf.call(o.parentNode.children, o);
          }
          function f({ source: o, over: n, overContainer: g, children: M }) {
            const j = !M.length, A = o.parentNode !== g;
            return j ? (function(h, c) {
              const y = h.parentNode;
              return c.appendChild(h), { oldContainer: y, newContainer: c };
            })(o, g) : n && !A ? (function(h, c) {
              const y = b(h), v = b(c);
              return y < v ? h.parentNode.insertBefore(h, c.nextElementSibling) : h.parentNode.insertBefore(h, c), { oldContainer: h.parentNode, newContainer: h.parentNode };
            })(o, n) : A ? (function(h, c, y) {
              const v = h.parentNode;
              return c ? c.parentNode.insertBefore(h, c) : y.appendChild(h), { oldContainer: v, newContainer: h.parentNode };
            })(o, n, g) : null;
          }
          e.default = C;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t = Object.assign || function(a) {
            for (var l = 1; l < arguments.length; l++) {
              var d = arguments[l];
              for (var m in d) Object.prototype.hasOwnProperty.call(d, m) && (a[m] = d[m]);
            }
            return a;
          };
          const r = Symbol("canceled");
          class s {
            constructor(l) {
              this[r] = !1, this.data = l;
            }
            get type() {
              return this.constructor.type;
            }
            get cancelable() {
              return this.constructor.cancelable;
            }
            cancel() {
              this[r] = !0;
            }
            canceled() {
              return !!this[r];
            }
            clone(l) {
              return new this.constructor(t({}, this.data, l));
            }
          }
          e.default = s, s.type = "event", s.cancelable = !1;
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 }), e.SortableStopEvent = e.SortableSortedEvent = e.SortableSortEvent = e.SortableStartEvent = e.SortableEvent = void 0;
          var t, r = i(3), s = (t = r) && t.__esModule ? t : { default: t };
          class a extends s.default {
            get dragEvent() {
              return this.data.dragEvent;
            }
          }
          e.SortableEvent = a, a.type = "sortable";
          class l extends a {
            get startIndex() {
              return this.data.startIndex;
            }
            get startContainer() {
              return this.data.startContainer;
            }
          }
          e.SortableStartEvent = l, l.type = "sortable:start", l.cancelable = !0;
          class d extends a {
            get currentIndex() {
              return this.data.currentIndex;
            }
            get over() {
              return this.data.oldIndex;
            }
            get overContainer() {
              return this.data.newIndex;
            }
          }
          e.SortableSortEvent = d, d.type = "sortable:sort", d.cancelable = !0;
          class m extends a {
            get oldIndex() {
              return this.data.oldIndex;
            }
            get newIndex() {
              return this.data.newIndex;
            }
            get oldContainer() {
              return this.data.oldContainer;
            }
            get newContainer() {
              return this.data.newContainer;
            }
          }
          e.SortableSortedEvent = m, m.type = "sortable:sorted";
          class u extends a {
            get oldIndex() {
              return this.data.oldIndex;
            }
            get newIndex() {
              return this.data.newIndex;
            }
            get oldContainer() {
              return this.data.oldContainer;
            }
            get newContainer() {
              return this.data.newContainer;
            }
          }
          e.SortableStopEvent = u, u.type = "sortable:stop";
        }, function(S, e, i) {
          Object.defineProperty(e, "__esModule", { value: !0 });
          var t = i(9);
          Object.keys(t).forEach((function(l) {
            l !== "default" && l !== "__esModule" && Object.defineProperty(e, l, { enumerable: !0, get: function() {
              return t[l];
            } });
          }));
          var r, s = i(41), a = (r = s) && r.__esModule ? r : { default: r };
          e.default = a.default;
        }]);
      }, P.exports = z();
    })), X = (D = _) && D.__esModule && Object.prototype.hasOwnProperty.call(D, "default") ? D.default : D;
    if (window.Livewire === void 0) throw "Livewire Sortable Plugin: window.Livewire is undefined. Make sure @livewireScripts is placed above this script include";
    window.Livewire.directive("sortable-group", ({ el: P, directive: Y, component: z }) => {
      if (Y.modifiers.includes("item-group") && P.closest("[wire\\:sortable-group]").livewire_sortable.addContainer(P), Y.modifiers.length > 0) return;
      let S = { draggable: "[wire\\:sortable-group\\.item]" };
      P.querySelector("[wire\\:sortable-group\\.handle]") && (S.handle = "[wire\\:sortable-group\\.handle]"), (P.livewire_sortable = new X([], S)).on("sortable:stop", () => {
        setTimeout(() => {
          let e = [];
          P.querySelectorAll("[wire\\:sortable-group\\.item-group]").forEach((i, t) => {
            let r = [];
            i.querySelectorAll("[wire\\:sortable-group\\.item]").forEach((s, a) => {
              r.push({ order: a + 1, value: s.getAttribute("wire:sortable-group.item") });
            }), e.push({ order: t + 1, value: i.getAttribute("wire:sortable-group.item-group"), items: r });
          }), z.$wire.call(Y.method, e);
        }, 1);
      });
    }), window.Livewire.directive("sortable", ({ el: P, directive: Y, component: z }) => {
      if (Y.modifiers.length > 0) return;
      let S = { draggable: "[wire\\:sortable\\.item]" };
      P.querySelector("[wire\\:sortable\\.handle]") && (S.handle = "[wire\\:sortable\\.handle]"), new X(P, S).on("sortable:stop", () => {
        setTimeout(() => {
          let e = [];
          P.querySelectorAll("[wire\\:sortable\\.item]").forEach((i, t) => {
            e.push({ order: t + 1, value: i.getAttribute("wire:sortable.item") });
          }), z.$wire.call(Y.method, e);
        }, 1);
      });
    });
  }))), R;
}
V();
window.LaravelMedia = {
  /**
   * Format file size in human readable format
   */
  formatFileSize(D) {
    if (D === 0) return "0 Bytes";
    const _ = 1024, X = ["Bytes", "KB", "MB", "GB"], P = Math.floor(Math.log(D) / Math.log(_));
    return parseFloat((D / Math.pow(_, P)).toFixed(2)) + " " + X[P];
  },
  /**
   * Get file type from MIME type
   */
  getFileType(D) {
    return D.startsWith("image/") ? "image" : D.startsWith("video/") ? "video" : D.startsWith("audio/") ? "audio" : D.includes("pdf") ? "pdf" : D.includes("word") || D.includes("document") ? "document" : D.includes("sheet") || D.includes("excel") ? "spreadsheet" : D.includes("presentation") || D.includes("powerpoint") ? "presentation" : "file";
  },
  /**
   * Validate file against allowed types and size
   */
  validateFile(D, _ = [], X = null) {
    const P = [];
    return _.length > 0 && !_.includes(D.type) && P.push(`File type ${D.type} is not allowed`), X && D.size > X * 1024 && P.push(`File size exceeds maximum of ${this.formatFileSize(X * 1024)}`), {
      valid: P.length === 0,
      errors: P
    };
  },
  /**
   * Create a preview URL for a file
   */
  createPreviewUrl(D) {
    return D.type.startsWith("image/") ? URL.createObjectURL(D) : null;
  }
};
document.addEventListener("alpine:init", () => {
  Alpine.data("mediaUpload", (D = {}) => ({
    files: [],
    uploading: !1,
    progress: 0,
    dragover: !1,
    allowedTypes: D.allowedTypes || [],
    maxSize: D.maxSize || null,
    maxFiles: D.maxFiles || null,
    multiple: D.multiple !== !1,
    init() {
      this.$refs.dropzone.addEventListener("dragover", (_) => {
        _.preventDefault(), this.dragover = !0;
      }), this.$refs.dropzone.addEventListener("dragleave", (_) => {
        _.preventDefault(), this.dragover = !1;
      }), this.$refs.dropzone.addEventListener("drop", (_) => {
        _.preventDefault(), this.dragover = !1, this.handleFiles(Array.from(_.dataTransfer.files));
      });
    },
    handleFiles(_) {
      const X = Array.from(_);
      if (this.maxFiles && this.files.length + X.length > this.maxFiles) {
        alert(`Maximum ${this.maxFiles} files allowed`);
        return;
      }
      X.forEach((P) => {
        const Y = LaravelMedia.validateFile(P, this.allowedTypes, this.maxSize);
        if (Y.valid) {
          const z = {
            file: P,
            name: P.name,
            size: P.size,
            type: P.type,
            preview: LaravelMedia.createPreviewUrl(P),
            uploading: !1,
            uploaded: !1,
            progress: 0,
            error: null
          };
          this.files.push(z);
        } else
          alert(Y.errors.join(`
`));
      });
    },
    removeFile(_) {
      const X = this.files[_];
      X.preview && URL.revokeObjectURL(X.preview), this.files.splice(_, 1);
    },
    async uploadFiles() {
      if (this.files.length !== 0) {
        this.uploading = !0;
        for (let _ = 0; _ < this.files.length; _++) {
          const X = this.files[_];
          if (!X.uploaded)
            try {
              await this.uploadFile(X, _);
            } catch (P) {
              X.error = P.message;
            }
        }
        this.uploading = !1;
      }
    },
    async uploadFile(_, X) {
      const P = new FormData();
      P.append("file", _.file), _.uploading = !0;
      try {
        const Y = await fetch("/media/upload", {
          method: "POST",
          body: P,
          headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
          }
        });
        if (Y.ok)
          _.uploaded = !0, _.progress = 100, this.$dispatch("file-uploaded", { file: _, response: await Y.json() });
        else
          throw new Error("Upload failed");
      } catch (Y) {
        _.error = Y.message;
      } finally {
        _.uploading = !1;
      }
    },
    formatFileSize(_) {
      return LaravelMedia.formatFileSize(_);
    },
    getFileType(_) {
      return LaravelMedia.getFileType(_);
    }
  })), Alpine.data("mediaGallery", (D = {}) => ({
    media: [],
    loading: !1,
    selectedItems: [],
    viewMode: D.viewMode || "grid",
    init() {
      this.loadMedia();
    },
    async loadMedia() {
      this.loading = !0, this.loading = !1;
    },
    toggleSelection(_) {
      const X = this.selectedItems.indexOf(_);
      X > -1 ? this.selectedItems.splice(X, 1) : this.selectedItems.push(_);
    },
    selectAll() {
      this.selectedItems = this.media.map((_) => _.id);
    },
    deselectAll() {
      this.selectedItems = [];
    },
    async deleteSelected() {
      if (this.selectedItems.length !== 0 && confirm(`Delete ${this.selectedItems.length} selected items?`))
        try {
          (await fetch("/media/bulk-delete", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify({ ids: this.selectedItems })
          })).ok && (this.loadMedia(), this.selectedItems = []);
        } catch (_) {
          console.error("Failed to delete media:", _);
        }
    }
  }));
});
