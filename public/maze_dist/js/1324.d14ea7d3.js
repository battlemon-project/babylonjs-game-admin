"use strict";(self["webpackChunkmaze"]=self["webpackChunkmaze"]||[]).push([[1324],{1324:function(e,t,n){n.r(t),n.d(t,{startInputShims:function(){return D}});var o=n(655),r=n(5626),i=new WeakMap,a=function(e,t,n,o){void 0===o&&(o=0),i.has(e)!==n&&(n?c(e,t,o):s(e,t))},u=function(e){return e===e.getRootNode().activeElement},c=function(e,t,n){var o=t.parentNode,r=t.cloneNode(!1);r.classList.add("cloned-input"),r.tabIndex=-1,o.appendChild(r),i.set(e,r);var a=e.ownerDocument,u="rtl"===a.dir?9999:-9999;e.style.pointerEvents="none",t.style.transform="translate3d("+u+"px,"+n+"px,0) scale(0)"},s=function(e,t){var n=i.get(e);n&&(i.delete(e),n.remove()),e.style.pointerEvents="",t.style.transform=""},l=function(e,t,n){if(!n||!t)return function(){};var o=function(n){u(t)&&a(e,t,n)},i=function(){return a(e,t,!1)},c=function(){return o(!0)},s=function(){return o(!1)};return(0,r.a)(n,"ionScrollStart",c),(0,r.a)(n,"ionScrollEnd",s),t.addEventListener("blur",i),function(){(0,r.b)(n,"ionScrollStart",c),(0,r.b)(n,"ionScrollEnd",s),t.addEventListener("ionBlur",i)}},d="input, textarea, [no-blur], [contenteditable]",f=function(){var e=!0,t=!1,n=document,o=function(){t=!0},i=function(){e=!0},a=function(o){if(t)t=!1;else{var r=n.activeElement;if(r&&!r.matches(d)){var i=o.target;i!==r&&(i.matches(d)||i.closest(d)||(e=!1,setTimeout((function(){e||r.blur()}),50)))}}};return(0,r.a)(n,"ionScrollStart",o),n.addEventListener("focusin",i,!0),n.addEventListener("touchend",a,!1),function(){(0,r.b)(n,"ionScrollStart",o,!0),n.removeEventListener("focusin",i,!0),n.removeEventListener("touchend",a,!1)}},v=.3,m=function(e,t,n){var o=e.closest("ion-item,[ion-item]")||e;return h(o.getBoundingClientRect(),t.getBoundingClientRect(),n,e.ownerDocument.defaultView.innerHeight)},h=function(e,t,n,o){var r=e.top,i=e.bottom,a=t.top,u=Math.min(t.bottom,o-n),c=a+15,s=.75*u,l=s-i,d=c-r,f=Math.round(l<0?-l:d>0?-d:0),m=Math.min(f,r-a),h=Math.abs(m),p=h/v,E=Math.min(400,Math.max(150,p));return{scrollAmount:m,scrollDuration:E,scrollPadding:n,inputSafeY:4-(r-c)}},p=function(e,t,n,o,i){var a,c=function(e){a=(0,r.p)(e)},s=function(c){if(a){var s=(0,r.p)(c);w(6,a,s)||u(t)||(c.stopPropagation(),E(e,t,n,o,i))}};return e.addEventListener("touchstart",c,!0),e.addEventListener("touchend",s,!0),function(){e.removeEventListener("touchstart",c,!0),e.removeEventListener("touchend",s,!0)}},E=function(e,t,n,i,u){return(0,o.mG)(void 0,void 0,void 0,(function(){var c,s,l,d,f,v;return(0,o.Jh)(this,(function(h){switch(h.label){case 0:return n||i?(c=m(e,n||i,u),n&&Math.abs(c.scrollAmount)<4?(t.focus(),[2]):(a(e,t,!0,c.inputSafeY),t.focus(),(0,r.r)((function(){return e.click()})),"undefined"===typeof window?[3,3]:(l=function(){return(0,o.mG)(void 0,void 0,void 0,(function(){return(0,o.Jh)(this,(function(o){switch(o.label){case 0:return void 0!==s&&clearTimeout(s),window.removeEventListener("ionKeyboardDidShow",d),window.removeEventListener("ionKeyboardDidShow",l),n?[4,n.scrollByPoint(0,c.scrollAmount,c.scrollDuration)]:[3,2];case 1:o.sent(),o.label=2;case 2:return a(e,t,!1,c.inputSafeY),t.focus(),[2]}}))}))},d=function(){window.removeEventListener("ionKeyboardDidShow",d),window.addEventListener("ionKeyboardDidShow",l)},n?[4,n.getScrollElement()]:[3,2]))):[2];case 1:if(f=h.sent(),v=f.scrollHeight-f.clientHeight,c.scrollAmount>v-f.scrollTop)return"password"===t.type?(c.scrollAmount+=50,window.addEventListener("ionKeyboardDidShow",d)):window.addEventListener("ionKeyboardDidShow",l),s=setTimeout(l,1e3),[2];h.label=2;case 2:l(),h.label=3;case 3:return[2]}}))}))},w=function(e,t,n){if(t&&n){var o=t.x-n.x,r=t.y-n.y,i=o*o+r*r;return i>e*e}return!1},b="$ionPaddingTimer",g=function(e){var t=document,n=function(t){y(t.target,e)},o=function(e){y(e.target,0)};return t.addEventListener("focusin",n),t.addEventListener("focusout",o),function(){t.removeEventListener("focusin",n),t.removeEventListener("focusout",o)}},y=function(e,t){if("INPUT"===e.tagName&&(!e.parentElement||"ION-INPUT"!==e.parentElement.tagName)&&(!e.parentElement||!e.parentElement.parentElement||"ION-SEARCHBAR"!==e.parentElement.parentElement.tagName)){var n=e.closest("ion-content");if(null!==n){var o=n[b];o&&clearTimeout(o),t>0?n.style.setProperty("--keyboard-offset",t+"px"):n[b]=setTimeout((function(){n.style.setProperty("--keyboard-offset","0px")}),120)}}},S=!0,L=!0,D=function(e){var t=document,n=e.getNumber("keyboardHeight",290),i=e.getBoolean("scrollAssist",!0),a=e.getBoolean("hideCaretOnScroll",!0),u=e.getBoolean("inputBlurring",!0),c=e.getBoolean("scrollPadding",!0),s=Array.from(t.querySelectorAll("ion-input, ion-textarea")),d=new WeakMap,v=new WeakMap,m=function(e){return(0,o.mG)(void 0,void 0,void 0,(function(){var t,u,c,s,f;return(0,o.Jh)(this,(function(o){switch(o.label){case 0:return[4,new Promise((function(t){return(0,r.c)(e,t)}))];case 1:return o.sent(),t=e.shadowRoot||e,u=t.querySelector("input")||t.querySelector("textarea"),c=e.closest("ion-content"),s=c?null:e.closest("ion-footer"),u?(c&&a&&!d.has(e)&&(f=l(e,u,c),d.set(e,f)),(c||s)&&i&&!v.has(e)&&(f=p(e,u,c,s,n),v.set(e,f)),[2]):[2]}}))}))},h=function(e){if(a){var t=d.get(e);t&&t(),d.delete(e)}if(i){t=v.get(e);t&&t(),v.delete(e)}};u&&S&&f(),c&&L&&g(n);for(var E=0,w=s;E<w.length;E++){var b=w[E];m(b)}t.addEventListener("ionInputDidLoad",(function(e){m(e.detail)})),t.addEventListener("ionInputDidUnload",(function(e){h(e.detail)}))}}}]);
//# sourceMappingURL=1324.d14ea7d3.js.map