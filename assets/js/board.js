!function(t){function e(n){if(a[n])return a[n].exports;var r=a[n]={i:n,l:!1,exports:{}};return t[n].call(r.exports,r,r.exports,e),r.l=!0,r.exports}var a={};e.m=t,e.c=a,e.d=function(t,a,n){e.o(t,a)||Object.defineProperty(t,a,{configurable:!1,enumerable:!0,get:n})},e.n=function(t){var a=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(a,"a",a),a},e.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},e.p="",e(e.s=388)}({388:function(t,e,a){"use strict";function n(t){return t&&t.__esModule?t:{default:t}}var r=a(389),o=n(r);n(a(390)).default.AssentVirtualGrid=function(){var t,e,a;return{getTemplate:function(){return["\x3c!--[D] 링크가 아닌 경우 div 로 교체 --\x3e",'<a href="{{profilePage}}" class="list-inner-item">',"\x3c!--[D] 실제 이미지 사이즈는 모바일 대응 위해 일대일 비율로 96*96 이상--\x3e",'<div class="img-thumbnail"><img src="{{profileImage}}" width="48" height="48" alt="{{displayName}}" /></div>','<div class="list-text">',"<p>{{displayName}}</p>","</div>","</a>"].join("\n")},init:function(){return t=AssentVirtualGrid,$(".xe-list-group").css("height","365px"),e=0,a=10,XeInfinite.init({wrapper:".xe-list-group",template:t.getTemplate(),loadRowCount:3,rowHeight:80,onGetRows:t.onGetRows}),t},onGetRows:function(){XeInfinite.setPrevent(!0);var t={limit:a};0!==e&&(t.startId=e),XE.ajax({url:$(".xe-list-group").data("url"),type:"get",dataType:"json",data:t,success:function(t){0===t.nextStartId?XeInfinite.setPrevent(!0):XeInfinite.setPrevent(!1),e=t.nextStartId;for(var a=0,n=t.list.length;a<n;a+=1)XeInfinite.addItems(t.list[a])}})}}}(),$(function(t){t(".__xe-bd-favorite").on("click",function(e){e.preventDefault();var a=t(e.target),n=a.closest("a"),r=n.data("id"),o=n.data("url");XE.ajax({url:o,type:"post",dataType:"json",data:{id:r}}).done(function(t){!0===t.favorite?n.addClass("on"):n.removeClass("on")})}),t(".__xe-forms .__xe-dropdown-form input").on("change",function(e){var a=t(e.target),n=t(".__xe_search");n.find('[name="'+a.attr("name")+'"]').val(a.val()),n.submit()}),t(".__xe-period .__xe-dropdown-form input").on("change",function(e){var a=t(e.target),n=(t(".__xe_search"),a.val()),r="",i=(0,o.default)().format("YYYY-MM-DD"),s=t(e.target).closest(".__xe-period").find('[name="start_created_at"]'),c=t(e.target).closest(".__xe-period").find('[name="end_created_at"]');switch(n){case"1week":r=(0,o.default)().add(-1,"weeks").format("YYYY-MM-DD");break;case"2week":r=(0,o.default)().add(-2,"weeks").format("YYYY-MM-DD");break;case"1month":r=(0,o.default)().add(-1,"months").format("YYYY-MM-DD");break;case"3month":r=(0,o.default)().add(-3,"months").format("YYYY-MM-DD");break;case"6month":r=(0,o.default)().add(-6,"months").format("YYYY-MM-DD");break;case"1year":r=(0,o.default)().add(-1,"years").format("YYYY-MM-DD")}s.val(r),c.val(i)}),t(".__xe-bd-mobile-sorting").on("click",function(){event.preventDefault();var e=t(".__xe-forms");e.hasClass("xe-hidden-xs")?(e.removeClass("xe-hidden-xs"),t(".board .bd_dimmed").show()):(e.addClass("xe-hidden-xs"),t(".board .bd_dimmed").hide())}),t(".__xe-bd-manage").on("click",function(){t(".bd_manage_detail").toggle()}),t(".__xe-bd-search").on("click",function(e){e.preventDefault(),t(this).toggleClass("on"),t(this).hasClass("on")?(t(".bd_search_area").show(),t(".bd_search_input").focus()):t(".bd_search_area").hide()}),t(".bd_btn_detail").on("click",function(e){t(this).toggleClass("on"),t(this).hasClass("on")?t(".bd_search_detail").show():t(".bd_search_detail").hide()}),t(".__xe_simple_search").on("submit",function(e){e.preventDefault();var a=t(".__xe_search");a.find('[name="title_pure_content"]').val(t(this).find('[name="title_pure_content"]').val()),a.submit()}),t(".bd_btn_cancel").on("click touchstart",function(e){e.preventDefault(),t(e.target).closest("form").find(".bd_search_detail").hide()}),t(".bd_btn_search").on("click touchstart",function(e){e.preventDefault(),t(e.target).closest("form").submit()}),t(".bd_btn_manage_check_all").on("click touchstart",function(e){t(".bd_manage_check").prop("checked",t(e.target).prop("checked"))}),t(".bd_btn_file").on("click touchstart",function(e){e.preventDefault(),t(e.target).closest("a").toggleClass("on")}),t(".bd_like").on("click touchstart",function(e){e.preventDefault();var a=t(e.target).closest("a"),n=a.data("url");XE.ajax({url:n,type:"post",dataType:"json"}).done(function(e){a.toggleClass("voted"),t(".bd_like_num").text(e.counts.assent)})}),t(".bd_delete").on("click touchstart",function(e){if(e.preventDefault(),confirm(XE.Lang.trans("board::msgDeleteConfirm"))){var a=t(this).data("url"),n=t("<form>",{action:a,method:"post"}).append(t("<input>",{type:"hidden",name:"_token",value:XE.Request.options.headers["X-CSRF-TOKEN"]})).append(t("<input>",{type:"hidden",name:"_method",value:"delete"}));t("body").append(n),n.submit()}}),t(".bd_like_num").on("click touchstart",function(e){if(e.preventDefault(),0!=parseInt(t(e.target).text())){var a=t(e.target).closest("a"),n=a.data("url");XE.page(n,"#bd_like_more"+a.data("id"),{},function(){t("#bd_like_more"+a.data("id")).show()})}}),t(".bd_like_more_text a").on("click touchstart",function(e){if(e.preventDefault(),0!=parseInt(t(e.target).text())){var a=t(e.target).closest("a"),n=a.prop("href");XE.pageModal(n)}}),t(".bd_share").on("click touchstart",function(e){e.preventDefault(),t(e.target).closest("a").toggleClass("on")});var e=function(t,e,a,n,r){if(a>r){var o=r/a;t.css("height",r),t.css("width",e*o);var e=e*o,a=a*o}};t(".board_list .thumb_area img").each(function(){var a=t(this);if(void 0===a.data("resize")){var n=(a.prop("clientWidth"),a.prop("naturalWidth")),r=a.prop("clientHeight"),o=a.prop("naturalHeight");0!=n&&0!=r&&(a.data("resize","1"),e(a,n,o,0,r))}}),t(".board_list .thumb_area img").bind("load",function(){var a=t(this);if(void 0===a.data("resize")){a.data("resize","2");var n=(a.prop("clientWidth"),a.prop("naturalWidth")),r=parseInt(a.css("max-height").replace("px","")),o=a.prop("naturalHeight");e(a,n,o,0,r)}})}),$(function(t){t(".__board_form").on("click",".__xe_btn_submit",function(e){e.preventDefault();var a=t(this),n=a.closest("form");n.data("valid-result")||n.trigger("submit")}).on("click",".__xe_btn_preview",function(e){e.preventDefault();var a=t(this).parents("form"),n=a.attr("action"),r=a.attr("target");a.attr("action",a.data("url-preview")),a.attr("target","_blank"),a.submit(),a.attr("action",n),a.attr("target",void 0===r?"":r)}).on("click",".__xe_temp_btn_save",function(t){})}),$(function(t){t(".__xe_copy .__xe_btn_submit").on("click",function(n){if(n.preventDefault(),!1!==e()){var r=a(),o=t(".__xe_copy").find('[name="copyTo"]').val();if(""==o)return void XE.toast("warning",XE.Lang.trans("board::selectBoard"));t.ajax({type:"post",dataType:"json",data:{id:r,instance_id:o},url:t(n.target).data("url"),success:function(t){document.location.reload()}})}}),t(".__xe_move .__xe_btn_submit").on("click",function(n){if(!1!==e()){n.preventDefault();var r=a(),o=t(".__xe_move").find('[name="moveTo"]').val();if(""==o)return void XE.toast("warning",XE.Lang.trans("board::selectBoard"));t.ajax({type:"post",dataType:"json",data:{id:r,instance_id:o},url:t(n.target).data("url"),success:function(t){document.location.reload()}})}}),t(".__xe_to_trash").on("click","a:first",function(n){if(n.preventDefault(),!1!==e()){var r=a();t.ajax({type:"post",dataType:"json",data:{id:r},url:t(n.target).data("url"),success:function(t){document.location.reload()}})}}),t(".__xe_delete").on("click","a:first",function(n){if(n.preventDefault(),!1!==e()){var r=a();t.ajax({type:"post",dataType:"json",data:{id:r},url:t(n.target).data("url"),success:function(t){document.location.reload()}})}});var e=function(){return 0!=t(".bd_manage_check:checked").length||(XE.toast("warning",XE.Lang.trans("board::selectPost")),!1)},a=function(){var e=[];return t(".bd_manage_check:checked").each(function(){e.push(t(this).val())}),e}})},389:function(t,e){t.exports=moment},390:function(t,e){t.exports=window}});