"use strict";var __importDefault=this&&this.__importDefault||function(e){return e&&e.__esModule?e:{default:e}};Object.defineProperty(exports,"__esModule",{value:!0}),exports.Edit=void 0;const element_1=require("@wordpress/element");require("@woocommerce/settings");const block_templates_1=require("@woocommerce/block-templates"),components_1=require("@woocommerce/components"),compose_1=require("@wordpress/compose"),data_1=require("@wordpress/data"),create_taxonomy_modal_1=require("./create-taxonomy-modal"),use_taxonomy_search_1=__importDefault(require("./use-taxonomy-search")),use_product_entity_prop_1=__importDefault(require("../../../hooks/use-product-entity-prop"));function Edit({attributes:e,context:{postType:t,isInSelectedTab:a}}){const o=(0,block_templates_1.useWooBlockProps)(e),{hierarchical:r}=(0,data_1.useSelect)((t=>t("core").getTaxonomy(e.slug)||{hierarchical:!1})),{label:l,slug:n,property:i,createTitle:s,dialogNameHelpText:m,parentTaxonomyText:c,disabled:u,placeholder:p}=e,[_,d]=(0,element_1.useState)(""),[y,x]=(0,element_1.useState)([]),{searchEntity:h,isResolving:b}=(0,use_taxonomy_search_1.default)(n,{fetchParents:r}),f=(0,compose_1.useDebounce)((0,element_1.useCallback)((e=>{d(e),h(e||"").then(x)}),[r]),150);(0,element_1.useEffect)((()=>{a&&f("")}),[a]);const[g,S]=(0,use_product_entity_prop_1.default)(i,{postType:t,fallbackValue:[]}),v=(g||[]).map((e=>({value:String(e.id),label:e.name}))),[T,w]=(0,element_1.useState)(!1),C=y.map((e=>({parent:r&&e.parent&&e.parent>0?String(e.parent):void 0,label:e.name,value:String(e.id)})));return(0,element_1.createElement)("div",{...o},(0,element_1.createElement)(element_1.Fragment,null,(0,element_1.createElement)(components_1.__experimentalSelectTreeControl,{id:(0,compose_1.useInstanceId)(components_1.__experimentalSelectTreeControl,"woocommerce-taxonomy-select"),label:l,isLoading:b,disabled:u,multiple:!0,createValue:_,onInputChange:f,placeholder:p,shouldNotRecursivelySelect:!0,shouldShowCreateButton:e=>!e||-1===C.findIndex((t=>t.label.toLowerCase()===e.toLowerCase())),onCreateNew:()=>w(!0),items:C,selected:v,onSelect:e=>{Array.isArray(e)?S([...e.map((e=>({id:+e.value,name:e.label,parent:+(e.parent||0)}))),...g||[]]):S([{id:+e.value,name:e.label,parent:+(e.parent||0)},...g||[]])},onRemove:e=>{Array.isArray(e)?S((g||[]).filter((t=>!e.find((e=>e.value===String(t.id)))))):S((g||[]).filter((t=>String(t.id)!==e.value)))}}),T&&(0,element_1.createElement)(create_taxonomy_modal_1.CreateTaxonomyModal,{slug:n,hierarchical:r,title:s,dialogNameHelpText:m,parentTaxonomyText:c,onCancel:()=>w(!1),onCreate:e=>{w(!1),d(""),S([{id:e.id,name:e.name,parent:e.parent},...g||[]])},initialName:_})))}exports.Edit=Edit;