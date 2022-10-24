import { ref, unref, withCtx, createVNode, toDisplayString, openBlock, createBlock, createCommentVNode, Fragment, renderList, createTextVNode, withDirectives, vModelCheckbox, useSSRContext } from "vue";
import { ssrRenderComponent, ssrInterpolate, ssrRenderClass, ssrIncludeBooleanAttr, ssrRenderList, ssrLooseContain } from "vue/server-renderer";
import axios from "axios";
import { useToast } from "vue-toastification";
import { Head } from "@inertiajs/inertia-vue3";
import { _ as _sfc_main$1 } from "./AuthenticatedLayout.46023201.mjs";
import { Inertia } from "@inertiajs/inertia";
import { reactive, computed } from "@vue/reactivity";
import "./ApplicationLogo.331c46e2.mjs";
const _sfc_main = {
  __name: "UserRoles",
  __ssrInlineRender: true,
  props: {
    user: Object,
    userRoles: Object,
    _checker: String,
    edit: Boolean
  },
  setup(__props) {
    const props = __props;
    const changed = ref(false);
    const toast = useToast();
    const editRoles = reactive(props.userRoles);
    const hasRoles = computed(() => editRoles.filter((v) => v.has).map((v) => v.name));
    function checkRole(role) {
      return Object.keys(props.user[0].roles).map((key) => props.user[0].roles[key]["id"]).includes(role);
    }
    function editUserRole() {
      axios.post(route("admin.acl.user.roles.edit", props.user[0].id), {
        roles: hasRoles.value,
        _checker: props._checker
      }).then((r) => {
        Inertia.reload();
        toast.success("Pap\xE9is do usu\xE1rio redefinidos.");
      }).catch();
    }
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<!--[-->`);
      _push(ssrRenderComponent(unref(Head), { title: "Editar Pap\xE9is" }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$1, null, {
        header: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<h2 class="font-semibold text-xl text-gray-800 leading-tight"${_scopeId}><p class="text-blue-900"${_scopeId}><strong${_scopeId}>Pap\xE9is de: </strong></p><p class="text-blue-900"${_scopeId}>Nome: ${ssrInterpolate(_ctx.$page.props.user[0].name)}</p><p class="text-blue-900"${_scopeId}>E-mail: ${ssrInterpolate(_ctx.$page.props.user[0].email)}</p><p class="text-blue-900"${_scopeId}>CPF: ${ssrInterpolate(_ctx.$page.props.user[0].cpf)}</p></h2>`);
          } else {
            return [
              createVNode("h2", { class: "font-semibold text-xl text-gray-800 leading-tight" }, [
                createVNode("p", { class: "text-blue-900" }, [
                  createVNode("strong", null, "Pap\xE9is de: ")
                ]),
                createVNode("p", { class: "text-blue-900" }, "Nome: " + toDisplayString(_ctx.$page.props.user[0].name), 1),
                createVNode("p", { class: "text-blue-900" }, "E-mail: " + toDisplayString(_ctx.$page.props.user[0].email), 1),
                createVNode("p", { class: "text-blue-900" }, "CPF: " + toDisplayString(_ctx.$page.props.user[0].cpf), 1)
              ])
            ];
          }
        }),
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<div class="py-0 px-0 mt-3"${_scopeId}><div class="max-w-7xl mx-auto"${_scopeId}><div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"${_scopeId}><div class="relative flex items-top justify-center sm:items-center sm:pt-0"${_scopeId}><div class="py-2 overflow-x-auto mt-2"${_scopeId}><div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg"${_scopeId}>`);
            if (_ctx.$page.props.edit) {
              _push2(`<button class="${ssrRenderClass([!changed.value ? "bg-blue-200 hover:bg-blue-200" : "", "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"])}"${ssrIncludeBooleanAttr(!changed.value) ? " disabled" : ""}${_scopeId}> Atualizar </button>`);
            } else {
              _push2(`<!---->`);
            }
            if (!_ctx.$page.props.edit) {
              _push2(`<button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"${_scopeId}> Editar </button>`);
            } else {
              _push2(`<!---->`);
            }
            _push2(`<table class="min-w-full mb-2"${_scopeId}><thead class="text-center"${_scopeId}><tr${_scopeId}><!--[-->`);
            ssrRenderList(["#", "Papel", _ctx.$page.props.edit ? "Atual/Alterar" : "Atual"], (value, index) => {
              _push2(`<th class="px-6 py-3 border-b-2 border-gray-300 leading-4 text-blue-500 tracking-wider"${_scopeId}>${ssrInterpolate(value)}</th>`);
            });
            _push2(`<!--]--></tr></thead><tbody class="bg-white text-center"${_scopeId}><!--[-->`);
            ssrRenderList(editRoles, (v, i) => {
              _push2(`<tr${_scopeId}><td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"${_scopeId}>${ssrInterpolate(v.id)}</td><td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"${_scopeId}>${ssrInterpolate(v.name)}</td><td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500"${_scopeId}><input type="checkbox" class="w-4 h-4 text-blue-600 bg-red-200 rounded border-gray-300 focus:ring-green-500 focus:ring-2"${ssrIncludeBooleanAttr(checkRole(v.id)) ? " checked" : ""} disabled${_scopeId}> ${ssrInterpolate(_ctx.$page.props.edit ? "/" : "")} `);
              if (_ctx.$page.props.edit) {
                _push2(`<input type="checkbox" class="w-4 h-4 text-green-600 bg-gray-100 rounded border-gray-300 focus:ring-green-500 focus:ring-2"${ssrIncludeBooleanAttr(checkRole(v.id)) ? " checked" : ""}${ssrIncludeBooleanAttr(Array.isArray(v.has) ? ssrLooseContain(v.has, null) : v.has) ? " checked" : ""}${_scopeId}>`);
              } else {
                _push2(`<!---->`);
              }
              _push2(`</td></tr>`);
            });
            _push2(`<!--]--></tbody></table>`);
            if (_ctx.$page.props.edit) {
              _push2(`<button class="${ssrRenderClass([!changed.value ? "bg-blue-200 hover:bg-blue-200" : "", "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mb-2"])}"${ssrIncludeBooleanAttr(!changed.value) ? " disabled" : ""}${_scopeId}> Atualizar </button>`);
            } else {
              _push2(`<!---->`);
            }
            _push2(`</div></div></div></div></div></div>`);
          } else {
            return [
              createVNode("div", { class: "py-0 px-0 mt-3" }, [
                createVNode("div", { class: "max-w-7xl mx-auto" }, [
                  createVNode("div", { class: "bg-white overflow-hidden shadow-xl sm:rounded-lg" }, [
                    createVNode("div", { class: "relative flex items-top justify-center sm:items-center sm:pt-0" }, [
                      createVNode("div", { class: "py-2 overflow-x-auto mt-2" }, [
                        createVNode("div", { class: "align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg" }, [
                          _ctx.$page.props.edit ? (openBlock(), createBlock("button", {
                            key: 0,
                            onClick: editUserRole,
                            class: ["text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center", !changed.value ? "bg-blue-200 hover:bg-blue-200" : ""],
                            disabled: !changed.value
                          }, " Atualizar ", 10, ["disabled"])) : createCommentVNode("", true),
                          !_ctx.$page.props.edit ? (openBlock(), createBlock("button", {
                            key: 1,
                            onClick: ($event) => (_ctx.$page.props.edit = true, changed.value = false),
                            class: "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                          }, " Editar ", 8, ["onClick"])) : createCommentVNode("", true),
                          createVNode("table", { class: "min-w-full mb-2" }, [
                            createVNode("thead", { class: "text-center" }, [
                              createVNode("tr", null, [
                                (openBlock(true), createBlock(Fragment, null, renderList(["#", "Papel", _ctx.$page.props.edit ? "Atual/Alterar" : "Atual"], (value, index) => {
                                  return openBlock(), createBlock("th", {
                                    key: index + "" + value,
                                    class: "px-6 py-3 border-b-2 border-gray-300 leading-4 text-blue-500 tracking-wider"
                                  }, toDisplayString(value), 1);
                                }), 128))
                              ])
                            ]),
                            createVNode("tbody", { class: "bg-white text-center" }, [
                              (openBlock(true), createBlock(Fragment, null, renderList(editRoles, (v, i) => {
                                return openBlock(), createBlock("tr", {
                                  key: "role_" + v.id
                                }, [
                                  createVNode("td", { class: "px-6 py-4 whitespace-no-wrap border-b border-gray-500" }, toDisplayString(v.id), 1),
                                  createVNode("td", { class: "px-6 py-4 whitespace-no-wrap border-b border-gray-500" }, toDisplayString(v.name), 1),
                                  createVNode("td", { class: "px-6 py-4 whitespace-no-wrap border-b border-gray-500" }, [
                                    createVNode("input", {
                                      type: "checkbox",
                                      class: "w-4 h-4 text-blue-600 bg-red-200 rounded border-gray-300 focus:ring-green-500 focus:ring-2",
                                      checked: checkRole(v.id),
                                      disabled: ""
                                    }, null, 8, ["checked"]),
                                    createTextVNode(" " + toDisplayString(_ctx.$page.props.edit ? "/" : "") + " ", 1),
                                    _ctx.$page.props.edit ? withDirectives((openBlock(), createBlock("input", {
                                      key: 0,
                                      type: "checkbox",
                                      onClick: ($event) => changed.value = true,
                                      class: "w-4 h-4 text-green-600 bg-gray-100 rounded border-gray-300 focus:ring-green-500 focus:ring-2",
                                      checked: checkRole(v.id),
                                      "onUpdate:modelValue": ($event) => v.has = $event
                                    }, null, 8, ["onClick", "checked", "onUpdate:modelValue"])), [
                                      [vModelCheckbox, v.has]
                                    ]) : createCommentVNode("", true)
                                  ])
                                ]);
                              }), 128))
                            ])
                          ]),
                          _ctx.$page.props.edit ? (openBlock(), createBlock("button", {
                            key: 2,
                            onClick: editUserRole,
                            class: ["text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mb-2", !changed.value ? "bg-blue-200 hover:bg-blue-200" : ""],
                            disabled: !changed.value
                          }, " Atualizar ", 10, ["disabled"])) : createCommentVNode("", true)
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Admin/UserRoles.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
