!function(e,t){if("function"==typeof define&&define.amd)define(["exports","module"],t);else if("undefined"!=typeof exports&&"undefined"!=typeof module)t(exports,module);else{var n={exports:{}};t(n.exports,n),e.autosize=n.exports}}(this,function(e,t){"use strict";function n(e){function t(){var t=window.getComputedStyle(e,null);"vertical"===t.resize?e.style.resize="none":"both"===t.resize&&(e.style.resize="horizontal"),l="content-box"===t.boxSizing?-(parseFloat(t.paddingTop)+parseFloat(t.paddingBottom)):parseFloat(t.borderTopWidth)+parseFloat(t.borderBottomWidth),isNaN(l)&&(l=0),a()}function n(t){var n=e.style.width;e.style.width="0px",e.offsetWidth,e.style.width=n,e.style.overflowY=t,r()}function o(e){for(var t=[];e&&e.parentNode&&e.parentNode instanceof Element;)e.parentNode.scrollTop&&t.push({node:e.parentNode,scrollTop:e.parentNode.scrollTop}),e=e.parentNode;return t}function r(){var t=e.style.height,n=o(e),r=document.documentElement&&document.documentElement.scrollTop;e.style.height="auto";var i=e.scrollHeight+l;return 0===e.scrollHeight?void(e.style.height=t):(e.style.height=i+"px",s=e.clientWidth,n.forEach(function(e){e.node.scrollTop=e.scrollTop}),void(r&&(document.documentElement.scrollTop=r)))}function a(){r();var t=window.getComputedStyle(e,null),o=Math.round(parseFloat(t.height)),i=Math.round(parseFloat(e.style.height));if(o!==i?"visible"!==t.overflowY&&n("visible"):"hidden"!==t.overflowY&&n("hidden"),u!==o){u=o;var a=d("autosize:resized");e.dispatchEvent(a)}}if(e&&e.nodeName&&"TEXTAREA"===e.nodeName&&!i.has(e)){var l=null,s=e.clientWidth,u=null,c=function(){e.clientWidth!==s&&a()},p=function(t){window.removeEventListener("resize",c,!1),e.removeEventListener("input",a,!1),e.removeEventListener("keyup",a,!1),e.removeEventListener("autosize:destroy",p,!1),e.removeEventListener("autosize:update",a,!1),i.delete(e),Object.keys(t).forEach(function(n){e.style[n]=t[n]})}.bind(e,{height:e.style.height,resize:e.style.resize,overflowY:e.style.overflowY,overflowX:e.style.overflowX,wordWrap:e.style.wordWrap});e.addEventListener("autosize:destroy",p,!1),"onpropertychange"in e&&"oninput"in e&&e.addEventListener("keyup",a,!1),window.addEventListener("resize",c,!1),e.addEventListener("input",a,!1),e.addEventListener("autosize:update",a,!1),i.add(e),e.style.overflowX="hidden",e.style.wordWrap="break-word",t()}}function o(e){if(e&&e.nodeName&&"TEXTAREA"===e.nodeName){var t=d("autosize:destroy");e.dispatchEvent(t)}}function r(e){if(e&&e.nodeName&&"TEXTAREA"===e.nodeName){var t=d("autosize:update");e.dispatchEvent(t)}}var i="function"==typeof Set?new Set:function(){var e=[];return{has:function(t){return Boolean(e.indexOf(t)>-1)},add:function(t){e.push(t)},delete:function(t){e.splice(e.indexOf(t),1)}}}(),d=function(e){return new Event(e)};try{new Event("test")}catch(e){d=function(e){var t=document.createEvent("Event");return t.initEvent(e,!0,!1),t}}var a=null;"undefined"==typeof window||"function"!=typeof window.getComputedStyle?(a=function(e){return e},a.destroy=function(e){return e},a.update=function(e){return e}):(a=function(e,t){return e&&Array.prototype.forEach.call(e.length?e:[e],function(e){return n(e,t)}),e},a.destroy=function(e){return e&&Array.prototype.forEach.call(e.length?e:[e],o),e},a.update=function(e){return e&&Array.prototype.forEach.call(e.length?e:[e],r),e}),t.exports=a});
!function(e){"function"==typeof define&&define.amd?define(["jquery"],e):"object"==typeof module&&module.exports?module.exports=e(require("jquery")):e(jQuery)}(function(e){var n={},t={};e.ajaxq=function(r,a){function i(e){if(n[r])n[r].push(e);else{n[r]=[];var a=e();t[r]=a}}function o(){if(n[r]){var e=n[r].shift();if(e){var a=e();t[r]=a}else delete n[r],delete t[r]}}if("undefined"==typeof a)throw"AjaxQ: queue name is not provided";var u=e.Deferred(),f=u.promise();f.success=f.done,f.error=f.fail,f.complete=f.always;var s="function"==typeof a,c=s?null:e.extend(!0,{},a);return i(function(){var n=e.ajax.apply(window,[s?a():c]);return n.done(function(){u.resolve.apply(this,arguments)}),n.fail(function(){u.reject.apply(this,arguments)}),n.always(o),n}),f},e.each(["getq","postq"],function(n,t){e[t]=function(n,r,a,i,o){return e.isFunction(a)&&(o=o||i,i=a,a=void 0),e.ajaxq(n,{type:"postq"===t?"post":"get",url:r,data:a,success:i,dataType:o})}});var r=function(e){return n.hasOwnProperty(e)&&n[e].length>0||t.hasOwnProperty(e)},a=function(){for(var e in n)if(r(e))return!0;return!1};e.ajaxq.isRunning=function(e){return e?r(e):a()},e.ajaxq.getActiveRequest=function(e){if(!e)throw"AjaxQ: queue name is required";return t[e]},e.ajaxq.abort=function(r){if(!r)throw"AjaxQ: queue name is required";var a=e.ajaxq.getActiveRequest(r);delete n[r],delete t[r],a&&a.abort()},e.ajaxq.clear=function(e){if(e)n[e]&&(n[e]=[]);else for(var t in n)n.hasOwnProperty(t)&&(n[t]=[])}});
window.Barryvanveen=window.Barryvanveen||{},window.Barryvanveen.admin=function(){window.Barryvanveen.callTimer=[],window.Barryvanveen.initClickableTableRows(),window.Barryvanveen.initAutosizeTextareas(),window.Barryvanveen.initMarkdownEditors(),window.Barryvanveen.initCharacterCounters(),window.Barryvanveen.initLogModal()},window.Barryvanveen.initClickableTableRows=function(){$(".js-clickable-row").mousedown(function(n){if(n.preventDefault(),2==n.which){var a=window.open($(this).data("href"),"_blank");return void(a&&a.focus())}window.document.location=$(this).data("href")})},window.Barryvanveen.initAutosizeTextareas=function(){autosize($("textarea"))},window.Barryvanveen.abortPostQueue=function(n){$.ajaxq.abort(n)},window.Barryvanveen.MarkdownEditor=function(n){var a=$(n),e=$("div[data-markdown-editor-name="+n.name+"]"),r=a.attr("name");this.updateMarkdownEditor=function(){"undefined"!=typeof window.Barryvanveen.callTimer[r]&&clearTimeout(window.Barryvanveen.callTimer[r]),window.Barryvanveen.callTimer[r]=setTimeout(function(){Barryvanveen.abortPostQueue(a.attr("name")),$.postq(r,Barryvanveen.markdownToHtmlRoute,{markdown:a.val()},function(n){e.html(n.html),Prism.highlightAll()},"json")},1e3)},a.keyup(this.updateMarkdownEditor),this.updateMarkdownEditor()},window.Barryvanveen.initMarkdownEditors=function(){$("textarea.js-markdown-editor").each(function(n,a){window.Barryvanveen.editor=new window.Barryvanveen.MarkdownEditor(a)})},window.Barryvanveen.CharacterCounter=function(n){var a=$(n),e=a.data("character-counter-name"),r=$('textarea[name="'+e+'"]');this.updateCounter=function(){a.html(r.val().length)},r.keyup(this.updateCounter),this.updateCounter()},window.Barryvanveen.initCharacterCounters=function(){$(".js-character-counter").each(function(n,a){window.Barryvanveen.counter=new window.Barryvanveen.CharacterCounter(a)})},window.Barryvanveen.initLogModal=function(){$("#logModal").on("show.bs.modal",function(n){var a=$(n.relatedTarget),e=a.data("level"),r=a.data("text"),t=a.data("file"),o=a.data("stack"),i=$(this);i.find(".modal-title").html(e+": "+r),i.find(".modal-body").html("<small>In file "+t+"<br><br>"+o+"</small>")})},window.Barryvanveen.admin();
//# sourceMappingURL=maps/admin.js.map
