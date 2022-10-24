import { ref, resolveComponent, unref, withCtx, createVNode, useSSRContext, openBlock, createBlock, createTextVNode, createCommentVNode } from "vue";
import { ssrRenderAttr, ssrRenderList, ssrInterpolate, ssrRenderClass, ssrRenderComponent } from "vue/server-renderer";
import { _ as _sfc_main$2 } from "./AuthenticatedLayout.46023201.mjs";
import { Link, Head } from "@inertiajs/inertia-vue3";
import "axios";
import { useToast } from "vue-toastification";
import "./ApplicationLogo.331c46e2.mjs";
const _sfc_main$1 = {
  __name: "AclUsers",
  __ssrInlineRender: true,
  setup(__props) {
    useToast();
    const usersList = ref({});
    const searchUsers = ref("");
    return (_ctx, _push, _parent, _attrs) => {
      const _component_mdicon = resolveComponent("mdicon");
      _push(`<!--[--><h1 class="text-lg text-center mb-2">Usu\xE1rios</h1><form class="flex items-center"><label for="voice-search" class="sr-only">Buscar</label><div class="relative w-full"><div class="flex absolute inset-y-0 left-0 items-center pl-1 pointer-events-none"><svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg></div><input type="text"${ssrRenderAttr("value", searchUsers.value)} class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 p-2.5" placeholder="Busque por nome, CPF ou e-mail"></div><button type="submit" class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-blue-500 border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"><svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>Buscar </button></form><div class="py-0 px-0"><div class="max-w-7xl mx-auto"><div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"><div class="relative flex items-top justify-center sm:items-center sm:pt-0"><div class="py-2 overflow-x-auto mt-2"><div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg"><table class="min-w-full mb-2"><thead><tr><!--[-->`);
      ssrRenderList(["ID", "Nome", "E-mail", "CPF", "Situa\xE7\xE3o", "A\xE7\xF5es"], (value, index) => {
        _push(`<th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">${ssrInterpolate(value)}</th>`);
      });
      _push(`<!--]--></tr></thead><tbody class="bg-white"><!--[-->`);
      ssrRenderList(usersList.value, (v, i) => {
        _push(`<tr><!--[-->`);
        ssrRenderList(v, (value, index) => {
          _push(`<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">`);
          if (index === "active") {
            _push(`<span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"><span aria-hidden class="${ssrRenderClass([value === 1 ? "bg-green-200" : "bg-red-200", "absolute inset-0 opacity-50 rounded-full"])}"></span><span class="relative text-xs">${ssrInterpolate(value === 1 ? "ativo" : "inativo")}</span></span>`);
          } else {
            _push(`<div class="text-sm leading-5 text-blue-900">${ssrInterpolate(value)}</div>`);
          }
          _push(`</td>`);
        });
        _push(`<!--]--><td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"><div class="grid grid-cols-4 gap-6">`);
        _push(ssrRenderComponent(unref(Link), {
          href: _ctx.route("admin.acl.user.roles.list", v.id)
        }, {
          default: withCtx((_, _push2, _parent2, _scopeId) => {
            if (_push2) {
              _push2(ssrRenderComponent(_component_mdicon, {
                name: "shield-account",
                class: "text-green-600",
                title: "Detalhes"
              }, null, _parent2, _scopeId));
            } else {
              return [
                createVNode(_component_mdicon, {
                  name: "shield-account",
                  class: "text-green-600",
                  title: "Detalhes"
                })
              ];
            }
          }),
          _: 2
        }, _parent));
        _push(ssrRenderComponent(unref(Link), {
          href: _ctx.route("admin.acl.user.roles.show", v.id)
        }, {
          default: withCtx((_, _push2, _parent2, _scopeId) => {
            if (_push2) {
              _push2(ssrRenderComponent(_component_mdicon, {
                name: "shield-edit",
                class: "text-blue-600",
                title: "Editar"
              }, null, _parent2, _scopeId));
            } else {
              return [
                createVNode(_component_mdicon, {
                  name: "shield-edit",
                  class: "text-blue-600",
                  title: "Editar"
                })
              ];
            }
          }),
          _: 2
        }, _parent));
        _push(`</div></td></tr>`);
      });
      _push(`<!--]--></tbody></table></div></div></div></div></div></div><!--]-->`);
    };
  }
};
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Admin/AclUsers.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const _sfc_main = {
  __name: "Acl",
  __ssrInlineRender: true,
  setup(__props) {
    const tab = ref(1);
    const currentTab = (tabNumber) => tab.value = tabNumber;
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<!--[-->`);
      _push(ssrRenderComponent(unref(Head), { title: "Painel" }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$2, null, {
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
            _push2(`<div class="py-12"${_scopeId}><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"${_scopeId}><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"${_scopeId}><div class="py-6 px-1 bg-white border-b border-gray-200"${_scopeId}><div${_scopeId}><div class="container mx-auto"${_scopeId}><ul class="flex justify-center space-x-2 text-white"${_scopeId}><li${_scopeId}><button class="inline-block px-4 py-2 bg-blue-500 focus:outline-none"${_scopeId}> ACL </button></li><li${_scopeId}><button class="inline-block px-4 py-2 bg-blue-500 focus:outline-none"${_scopeId}> Usu\xE1rios </button></li><li${_scopeId}>`);
            _push2(ssrRenderComponent(unref(Link), {
              href: _ctx.route("admin.acl.roles.index")
            }, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(`<button class="inline-block px-4 py-2 bg-blue-500 focus:outline-none"${_scopeId2}> Pap\xE9is </button>`);
                } else {
                  return [
                    createVNode("button", { class: "inline-block px-4 py-2 bg-blue-500 focus:outline-none" }, " Pap\xE9is ")
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
            _push2(`</li><li${_scopeId}><button class="inline-block px-4 py-2 bg-blue-500 focus:outline-none"${_scopeId}> Permiss\xF5es </button></li></ul><div class="py-3 mt-6 text-justify bg-white"${_scopeId}>`);
            if (tab.value === 1) {
              _push2(`<div${_scopeId}><p class="mb-2"${_scopeId}><strong${_scopeId}>Usu\xE1rios</strong>: Busque por usu\xE1rios do sistema. Ative, desative, atribua e remova pap\xE9is atribu\xEDdos.</p><p class="mb-2"${_scopeId}><strong${_scopeId}>Pap\xE9is</strong>: Lista de pap\xE9is a serem atru\xEDdos a usu\xE1rios do sistema. Cada papel pode ter v\xE1rias permiss\xF5es atribu\xEDdas.</p><p class="mb-2"${_scopeId}><strong${_scopeId}>Permiss\xF5es</strong>: Lista de permiss\xF5es a serem atru\xEDdas a pap\xE9is. Permiss\xF5es definem cada a\xE7\xE3o do sistema. Ex.: Criar Paciente, Editar Paciente, Apagar Paciente, etc.</p></div>`);
            } else {
              _push2(`<!---->`);
            }
            if (tab.value === 2) {
              _push2(`<div${_scopeId}>`);
              _push2(ssrRenderComponent(_sfc_main$1, null, null, _parent2, _scopeId));
              _push2(`</div>`);
            } else {
              _push2(`<!---->`);
            }
            if (tab.value === 3) {
              _push2(`<div${_scopeId}> Permiss\xF5es </div>`);
            } else {
              _push2(`<!---->`);
            }
            _push2(`</div></div></div></div></div></div></div>`);
          } else {
            return [
              createVNode("div", { class: "py-12" }, [
                createVNode("div", { class: "max-w-7xl mx-auto sm:px-6 lg:px-8" }, [
                  createVNode("div", { class: "bg-white overflow-hidden shadow-sm sm:rounded-lg" }, [
                    createVNode("div", { class: "py-6 px-1 bg-white border-b border-gray-200" }, [
                      createVNode("div", null, [
                        createVNode("div", { class: "container mx-auto" }, [
                          createVNode("ul", { class: "flex justify-center space-x-2 text-white" }, [
                            createVNode("li", null, [
                              createVNode("button", {
                                onClick: ($event) => currentTab(1),
                                class: "inline-block px-4 py-2 bg-blue-500 focus:outline-none"
                              }, " ACL ", 8, ["onClick"])
                            ]),
                            createVNode("li", null, [
                              createVNode("button", {
                                onClick: ($event) => currentTab(2),
                                class: "inline-block px-4 py-2 bg-blue-500 focus:outline-none"
                              }, " Usu\xE1rios ", 8, ["onClick"])
                            ]),
                            createVNode("li", null, [
                              createVNode(unref(Link), {
                                href: _ctx.route("admin.acl.roles.index")
                              }, {
                                default: withCtx(() => [
                                  createVNode("button", { class: "inline-block px-4 py-2 bg-blue-500 focus:outline-none" }, " Pap\xE9is ")
                                ]),
                                _: 1
                              }, 8, ["href"])
                            ]),
                            createVNode("li", null, [
                              createVNode("button", {
                                onClick: ($event) => currentTab(3),
                                class: "inline-block px-4 py-2 bg-blue-500 focus:outline-none"
                              }, " Permiss\xF5es ", 8, ["onClick"])
                            ])
                          ]),
                          createVNode("div", { class: "py-3 mt-6 text-justify bg-white" }, [
                            tab.value === 1 ? (openBlock(), createBlock("div", { key: 0 }, [
                              createVNode("p", { class: "mb-2" }, [
                                createVNode("strong", null, "Usu\xE1rios"),
                                createTextVNode(": Busque por usu\xE1rios do sistema. Ative, desative, atribua e remova pap\xE9is atribu\xEDdos.")
                              ]),
                              createVNode("p", { class: "mb-2" }, [
                                createVNode("strong", null, "Pap\xE9is"),
                                createTextVNode(": Lista de pap\xE9is a serem atru\xEDdos a usu\xE1rios do sistema. Cada papel pode ter v\xE1rias permiss\xF5es atribu\xEDdas.")
                              ]),
                              createVNode("p", { class: "mb-2" }, [
                                createVNode("strong", null, "Permiss\xF5es"),
                                createTextVNode(": Lista de permiss\xF5es a serem atru\xEDdas a pap\xE9is. Permiss\xF5es definem cada a\xE7\xE3o do sistema. Ex.: Criar Paciente, Editar Paciente, Apagar Paciente, etc.")
                              ])
                            ])) : createCommentVNode("", true),
                            tab.value === 2 ? (openBlock(), createBlock("div", { key: 1 }, [
                              createVNode(_sfc_main$1)
                            ])) : createCommentVNode("", true),
                            tab.value === 3 ? (openBlock(), createBlock("div", { key: 2 }, " Permiss\xF5es ")) : createCommentVNode("", true)
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Admin/Acl.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
