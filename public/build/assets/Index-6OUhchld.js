import{S as L}from"./SummernoteEditor-YXY0HYsX.js";import{_ as V}from"./TreeCategory-yz3vIs9N.js";import{C as T}from"./ComponentLoader-p7uzdx_k.js";import{_ as B}from"./Pagination-eDnx4Gf3.js";import{_ as D,aV as i,c as u,G as I,a as t,P as n,bA as x,F as N,aT as M,w as E,b as p,v as m,e as h,o as r,b7 as d,O as U}from"./app-cpAAYSkm.js";const z={name:"Index",components:{Pagination:B,ComponentLoader:T,SummernoteEditor:L,TreeCategory:V},data(){return{products:[],product:{},brands:[],productName:null,defaultPrice:null,defaultStoke:null,description:null,details:null,categoryId:null,brandId:null,loading:!1}},methods:{allProducts(s){this.loading=!0,this.$axios.get(s??"api/product").then(e=>{this.products=e.data}).catch(e=>{e.response.data.errors,Toast.fire({icon:"warning",title:e.response.statusText})}).finally(()=>this.loading=!1)},showSingleProduct(s){this.loading=!0,this.$axios.get("/api/product/"+s).then(e=>{$("#exampleModal").modal("show"),this.product=e.data}).catch(e=>{Toast.fire({icon:"error",title:e.response.statusText})}).finally(()=>this.loading=!1)},deleteProduct(s){Swal.fire({title:"Are You Sure!",text:"you watnt to delete this?",icon:"warning",confirmButtonColor:"#ddd",cancelButtonColor:"red",confirmButtonText:"Delete",showCancelButton:!0}).then(e=>{e.value&&(this.loading=!0,this.$axios.delete("/api/product/"+s).then(c=>{Toast.fire({icon:"success",title:c.data.message}),this.allProducts()}).catch(c=>{Toast.fire({icon:"error",title:c.response.statusText})}).finally(()=>this.loading=!1))}).catch(()=>{Swal.fire({icon:"success",title:"dont worry. your data is safe..."}),this.$router.push({name:"ManageEmployee"})})},saveProductDetails(){this.loading=!0;const s=new FormData;s.append("name",this.productName),s.append("defaultPrice",this.defaultPrice),s.append("defaultQty",this.defaultStoke),s.append("categoryId",this.categoryId),s.append("brandId",this.brandId),s.append("description",this.description),s.append("details",this.details),s.append("stock",this.defaultStoke),this.$axios.post("api/save-product-details",s).then(e=>{Toast.fire({icon:"success",title:e.data.message}),this.$refs.Close.click(),this.allProducts()}).catch(e=>{Toast.fire({icon:"error",title:e.response.data.message})}).finally(()=>this.loading=!1)},allBrands(){this.$axios.get("api/brand",this.from).then(s=>{this.brands=s.data}).catch(s=>{this.errors=s.response.data.errors,Toast.fire({icon:"warning",title:s.response.data.message})})}},created(){this.allProducts(),this.allBrands()}},A={key:1,class:"card card-custom"},F={class:"card-header flex-wrap py-5"},Z=t("div",{class:"card-title"},[t("h3",{class:"card-label"},[h("All Products "),t("span",{class:"d-block text-muted pt-2 font-size-sm"},"all product details is here ")])],-1),Q={class:"card-toolbar"},G=t("span",{class:"svg-icon svg-icon-md"},[t("svg",{xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink",width:"24px",height:"24px",viewBox:"0 0 24 24",version:"1.1"},[t("g",{stroke:"none","stroke-width":"1",fill:"none","fill-rule":"evenodd"},[t("rect",{x:"0",y:"0",width:"24",height:"24"}),t("circle",{fill:"#000000",cx:"9",cy:"15",r:"6"}),t("path",{d:"M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z",fill:"#000000",opacity:"0.3"})])])],-1),O={class:"card-body"},R={class:"table table-separate table-head-custom table-checkable table-borderless",id:""},Y=t("thead",null,[t("tr",null,[t("th",null,"Id"),t("td",{width:"35%"},"Info"),t("th",null,"Image"),t("th",null,"Category"),t("th",null,"Brand"),t("th",null,"Actions")])],-1),j={class:"fw-bold text-capitalize"},q={class:"d-flex flex-column gap-1"},H=["src"],J={class:"text-capitalize"},K={class:"text-capitalize"},W=["onClick"],X=U('<span class="svg-icon svg-icon-dark svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"></path><path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path></g></svg></span>',1),tt=[X],et={class:"modal fade",id:"exampleModalLong","data-backdrop":"static",tabindex:"-1",role:"dialog","aria-labelledby":"staticBackdrop","aria-hidden":"true"},ot={class:"modal-dialog modal-lg",role:"document"},st={class:"modal-content"},lt={class:"modal-header"},at={class:"d-flex gap-3"},it=t("h5",{class:"modal-title",id:"exampleModalLabel"},"Add New",-1),nt={class:"d-flex gap-1"},dt={class:"btn btn-sm btn-danger",ref:"Close","data-dismiss":"modal","aria-label":"Close"},rt={type:"button",class:"close",ref:"Close","data-dismiss":"modal","aria-label":"Close"},ct=t("i",{"aria-hidden":"true",class:"ki ki-close"},null,-1),ut=[ct],pt={class:"modal-body"},mt={class:"form-row"},ht={class:"col-md-4 form-group"},ft=t("label",{for:"productname"},"Product Name",-1),_t={class:"col-md-4 form-group"},gt=t("label",{for:"dPrice"},"Default Price",-1),bt={class:"col-md-4 form-group"},vt=t("label",{for:"defaultStoke"},"Default Quantity",-1),xt={class:"form-row"},wt={class:"col-md-6 form-group"},yt=t("label",null,"Category",-1),kt={class:"col-md-6 form-group"},Ct=t("label",null,"Brand",-1),Pt={class:"form-group"},St=t("label",{for:"description"},"Description",-1),Lt={class:"form-group"},Vt=t("label",null,"Full Details",-1);function Tt(s,e,c,Bt,l,a){var _;const w=i("ComponentLoader"),f=i("router-link"),y=i("Pagination"),k=i("TreeCategory"),C=i("v-select"),P=i("SummernoteEditor");return r(),u("div",null,[l.loading?(r(),I(w,{key:0})):(r(),u("div",A,[t("div",F,[Z,t("div",Q,[n(f,{class:"btn btn-primary font-weight-bolder",to:"/add-product"},{default:x(()=>[G,h(" New Record ")]),_:1})])]),t("div",O,[t("table",R,[Y,t("tbody",null,[(r(!0),u(N,null,M((_=l.products)==null?void 0:_.data,(o,S)=>{var g,b,v;return r(),u("tr",null,[t("td",null,d(S+1),1),t("td",null,[t("div",null,[t("h6",j,d(o.title),1),t("div",q,[t("small",null,"Stoke: "+d(o.stock),1),t("small",null,"Price: "+d(o.buying_price),1)])])]),t("td",null,[t("img",{src:`/storage/uploads/${(g=o==null?void 0:o.images[0])==null?void 0:g.image}`,alt:"",style:{width:"73px",height:"70px","border-radius":"50px"}},null,8,H)]),t("td",null,[t("span",J,d((b=o.category)==null?void 0:b.name),1)]),t("td",null,[t("span",K,d((v=o.brand)==null?void 0:v.title),1)]),t("td",null,[n(f,{to:{name:"ModifyProduct",params:{id:o.id}},class:"btn btn-clean btn-primary",title:"Edit details"},{default:x(()=>[h(" Setup Product ")]),_:2},1032,["to"]),t("button",{class:"btn btn-icon btn-light-danger ms-2",title:"Edit details",onClick:Dt=>a.deleteProduct(o==null?void 0:o.id)},tt,8,W)])])}),256))])]),n(y,{onSomeEvent:a.allProducts,links:l.products.links,from:l.products.from,to:l.products.to,total:l.products.total,notShowNumber:!1},null,8,["onSomeEvent","links","from","to","total"])])])),t("div",et,[t("div",ot,[t("div",st,[t("div",lt,[t("div",at,[it,t("div",nt,[t("button",{class:"btn btn-sm btn-primary",onClick:e[0]||(e[0]=(...o)=>a.saveProductDetails&&a.saveProductDetails(...o))},"Save"),t("button",dt,"Cancel",512)])]),t("button",rt,ut,512)]),t("div",pt,[t("form",{onSubmit:e[8]||(e[8]=E((...o)=>a.saveProductDetails&&a.saveProductDetails(...o),["prevent"]))},[t("div",mt,[t("div",ht,[ft,p(t("input",{type:"text",id:"productname","onUpdate:modelValue":e[1]||(e[1]=o=>l.productName=o),placeholder:"Product Name",class:"form-control"},null,512),[[m,l.productName]])]),t("div",_t,[gt,p(t("input",{type:"text",id:"dPrice","onUpdate:modelValue":e[2]||(e[2]=o=>l.defaultPrice=o),placeholder:"Default Price.",class:"form-control"},null,512),[[m,l.defaultPrice]])]),t("div",bt,[vt,p(t("input",{type:"text",id:"defaultStoke","onUpdate:modelValue":e[3]||(e[3]=o=>l.defaultStoke=o),placeholder:"Default Quantity...",class:"form-control"},null,512),[[m,l.defaultStoke]])])]),t("div",xt,[t("div",wt,[yt,n(k,{modelValue:l.categoryId,"onUpdate:modelValue":e[4]||(e[4]=o=>l.categoryId=o)},null,8,["modelValue"])]),t("div",kt,[Ct,n(C,{modelValue:l.brandId,"onUpdate:modelValue":e[5]||(e[5]=o=>l.brandId=o),class:"form-control",reduce:o=>o.id,options:l.brands,label:"title",placeholder:"Select Brand..."},null,8,["modelValue","reduce","options"])])]),t("div",Pt,[St,p(t("textarea",{"onUpdate:modelValue":e[6]||(e[6]=o=>l.description=o),id:"description",cols:"30",rows:"4",class:"form-control"},null,512),[[m,l.description]])]),t("div",Lt,[Vt,n(P,{modelValue:l.details,"onUpdate:modelValue":e[7]||(e[7]=o=>l.details=o)},null,8,["modelValue"])])],32)])])])])])}const zt=D(z,[["render",Tt]]);export{zt as default};