import { ref, resolveComponent, unref, withCtx, createVNode, openBlock, createBlock, Fragment, renderList, toDisplayString, useSSRContext } from "vue";
import { ssrRenderComponent, ssrRenderList, ssrInterpolate } from "vue/server-renderer";
import "axios";
import { useToast } from "vue-toastification";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { _ as _sfc_main$1 } from "./AuthenticatedLayout.46023201.mjs";
import "./ApplicationLogo.331c46e2.mjs";
const _sfc_main = {
  __name: "Roles",
  __ssrInlineRender: true,
  props: {
    rolesWithPermissions: Object
  },
  setup(__props) {
    const props = __props;
    useToast();
    const rolesWithPermissions = ref(props.rolesWithPermissions);
    return (_ctx, _push, _parent, _attrs) => {
      const _component_mdicon = resolveComponent("mdicon");
      _push(`<!--[-->`);
      _push(ssrRenderComponent(unref(Head), { title: "Painel" }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$1, null, {
        header: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<h2 class="font-semibold text-xl text-gray-800 leading-tight"${_scopeId}> Controle de Acesso </h2>`);
          } else {
            return [
              createVNode("h2", { class: "font-semibold text-xl text-gray-800 leading-tight" }, " Controle de Acesso ")
            ];
          }
        }),
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<div class="py-12"${_scopeId}><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"${_scopeId}><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"${_scopeId}><h1 class="text-lg text-center my-2"${_scopeId}>Pap\xE9is</h1><div class="py-0 px-0"${_scopeId}><div class="max-w-7xl mx-auto"${_scopeId}><div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"${_scopeId}><div class="relative flex items-top justify-center sm:items-center sm:pt-0"${_scopeId}><div class="py-2 overflow-x-auto mt-2"${_scopeId}><div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg"${_scopeId}><table class="min-w-full mb-2"${_scopeId}><thead${_scopeId}><tr${_scopeId}><!--[-->`);
            ssrRenderList(["ID", "Nome", "Permiss\xF5es", "A\xE7\xF5es"], (value, index) => {
              _push2(`<th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider"${_scopeId}>${ssrInterpolate(value)}</th>`);
            });
            _push2(`<!--]--></tr></thead><tbody class="bg-white"${_scopeId}><!--[-->`);
            ssrRenderList(rolesWithPermissions.value, (v, i) => {
              _push2(`<tr${_scopeId}><!--[-->`);
              ssrRenderList(v, (value, index) => {
                _push2(`<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"${_scopeId}>`);
                if (index === "permissions") {
                  _push2(`<!--[-->`);
                  ssrRenderList(v.permissions, (p, i2) => {
                    _push2(`<span class="relative inline-block px-2 py-0 font-semibold text-green-900 leading-tight m-0.5"${_scopeId}><span aria-hidden class="absolute inset-0 opacity-50 rounded-full bg-green-200 border border-green-600"${_scopeId}></span><span class="relative text-xs"${_scopeId}>${ssrInterpolate(p.name)}</span></span>`);
                  });
                  _push2(`<!--]-->`);
                } else {
                  _push2(`<div class="text-sm leading-5 text-blue-900"${_scopeId}>${ssrInterpolate(value)}</div>`);
                }
                _push2(`</td>`);
              });
              _push2(`<!--]--><td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"${_scopeId}><div class="grid grid-cols-4 gap-6"${_scopeId}>`);
              _push2(ssrRenderComponent(unref(Link), {
                href: _ctx.route("admin.acl.role.show", v.id)
              }, {
                default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                  if (_push3) {
                    _push3(ssrRenderComponent(_component_mdicon, {
                      name: "playlist-edit",
                      class: "text-blue-600",
                      title: "Editar"
                    }, null, _parent3, _scopeId2));
                  } else {
                    return [
                      createVNode(_component_mdicon, {
                        name: "playlist-edit",
                        class: "text-blue-600",
                        title: "Editar"
                      })
                    ];
                  }
                }),
                _: 2
              }, _parent2, _scopeId));
              _push2(ssrRenderComponent(unref(Link), {
                href: _ctx.route("admin.acl.user.roles.list", v.id)
              }, {
                default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                  if (_push3) {
                    _push3(ssrRenderComponent(_component_mdicon, {
                      name: "playlist-minus",
                      class: "text-yellow-500",
                      title: "Desativar"
                    }, null, _parent3, _scopeId2));
                  } else {
                    return [
                      createVNode(_component_mdicon, {
                        name: "playlist-minus",
                        class: "text-yellow-500",
                        title: "Desativar"
                      })
                    ];
                  }
                }),
                _: 2
              }, _parent2, _scopeId));
              _push2(`</div></td></tr>`);
            });
            _push2(`<!--]--></tbody></table></div></div></div></div></div></div></div></div></div>`);
          } else {
            return [
              createVNode("div", { class: "py-12" }, [
                createVNode("div", { class: "max-w-7xl mx-auto sm:px-6 lg:px-8" }, [
                  createVNode("div", { class: "bg-white overflow-hidden shadow-sm sm:rounded-lg" }, [
                    createVNode("h1", { class: "text-lg text-center my-2" }, "Pap\xE9is"),
                    createVNode("div", { class: "py-0 px-0" }, [
                      createVNode("div", { class: "max-w-7xl mx-auto" }, [
                        createVNode("div", { class: "bg-white overflow-hidden shadow-xl sm:rounded-lg" }, [
                          createVNode("div", { class: "relative flex items-top justify-center sm:items-center sm:pt-0" }, [
                            createVNode("div", { class: "py-2 overflow-x-auto mt-2" }, [
                              createVNode("div", { class: "align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg" }, [
                                createVNode("table", { class: "min-w-full mb-2" }, [
                                  createVNode("thead", null, [
                                    createVNode("tr", null, [
                                      (openBlock(), createBlock(Fragment, null, renderList(["ID", "Nome", "Permiss\xF5es", "A\xE7\xF5es"], (value, index) => {
                                        return createVNode("th", {
                                          key: index + "" + value,
                                          class: "px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider"
                                        }, toDisplayString(value), 1);
                                      }), 64))
                                    ])
                                  ]),
                                  createVNode("tbody", { class: "bg-white" }, [
                                    (openBlock(true), createBlock(Fragment, null, renderList(rolesWithPermissions.value, (v, i) => {
                                      return openBlock(), createBlock("tr", { key: i }, [
                                        (openBlock(true), createBlock(Fragment, null, renderList(v, (value, index) => {
                                          return openBlock(), createBlock("td", {
                                            class: "px-6 py-4 whitespace-no-wrap border-b border-gray-500",
                                            key: i.id + "" + index
                                          }, [
                                            index === "permissions" ? (openBlock(true), createBlock(Fragment, { key: 0 }, renderList(v.permissions, (p, i2) => {
                                              return openBlock(), createBlock("span", { class: "relative inline-block px-2 py-0 font-semibold text-green-900 leading-tight m-0.5" }, [
                                                createVNode("span", {
                                                  "aria-hidden": "",
                                                  class: "absolute inset-0 opacity-50 rounded-full bg-green-200 border border-green-600"
                                                }),
                                                createVNode("span", { class: "relative text-xs" }, toDisplayString(p.name), 1)
                                              ]);
                                            }), 256)) : (openBlock(), createBlock("div", {
                                              key: 1,
                                              class: "text-sm leading-5 text-blue-900"
                                            }, toDisplayString(value), 1))
                                          ]);
                                        }), 128)),
                                        createVNode("td", { class: "px-6 py-4 whitespace-no-wrap border-b border-gray-500" }, [
                                          createVNode("div", { class: "grid grid-cols-4 gap-6" }, [
                                            createVNode(unref(Link), {
                                              href: _ctx.route("admin.acl.role.show", v.id)
                                            }, {
                                              default: withCtx(() => [
                                                createVNode(_component_mdicon, {
                                                  name: "playlist-edit",
                                                  class: "text-blue-600",
                                                  title: "Editar"
                                                })
                                              ]),
                                              _: 2
                                            }, 1032, ["href"]),
                                            createVNode(unref(Link), {
                                              href: _ctx.route("admin.acl.user.roles.list", v.id)
                                            }, {
                                              default: withCtx(() => [
                                                createVNode(_component_mdicon, {
                                                  name: "playlist-minus",
                                                  class: "text-yellow-500",
                                                  title: "Desativar"
                                                })
                                              ]),
                                              _: 2
                                            }, 1032, ["href"])
                                          ])
                                        ])
                                      ]);
                                    }), 128))
                                  ])
                                ])
                              ])
                            ])
                          ])
                        ])
                      ])
                    ])
                  ])
                ])
              ])
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`<!--]-->`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Admin/Roles.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
