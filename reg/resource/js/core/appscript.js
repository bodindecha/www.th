function private(){function a(e){for(var t=e+"=",a=decodeURIComponent(document.cookie).split(";"),o=0;o<a.length;o++){for(var n=a[o];" "==n.charAt(0);)n=n.substring(1);if(0==n.indexOf(t))return n.substring(t.length,n.length)}return""}var i=[];$(document).on("keydown",function(e){var t=e.which||e.keyCode,a=(String.fromCharCode(t)||e.key||e.code,e.ctrlKey),o=e.shiftKey,n=e.altKey;i.push(t),3<i.length&&i.shift(),123==t||a&&o&&73==t?(e.preventDefault(),app.ui.notify(1,[2,"Function reserved for developers"])):a&&83==t?(e.preventDefault(),app.ui.notify(1,[2,"You can't save this webpage"])):n&&84==t?(app.ui.notify(1,[0,"Theme toggled"]),document.querySelector("html body header section div.head-item.clrt a").click()):n&&76==t?(app.ui.notify(1,[0,"Language changed"]),app.ui.toggle.langes()):n&&72==t&&app.io.warpto("")}),$(document).on("keyup",function(e){var t=e.which||e.keyCode;String.fromCharCode(t)||e.key||e.code,e.ctrlKey,e.shiftKey,e.altKey;i.push(t),3<i.length&&i.shift(),44==t&&(o(),app.ui.notify(1,[3,"Print Screen detected & blocked"]))});var o=function(){var e=document.createElement("input");e.setAttribute("value","."),e.setAttribute("width","0"),e.style.height="0px",e.style.width="0px",e.style.border="0px",document.body.appendChild(e),e.select(),document.execCommand("copy"),e.remove(e);try{window.clipboardData.setData("text","Access Restricted")}catch(e){}},t=!1;$(document).on("keydown keyup",function(e){t=e.ctrlKey});return{console_proof:function(){console.log('%cStop!\n%cThis is a browser feature intended for developers. If someone told you to copy and paste something here to enable a TianTcl.net feature or "hack" this web application, it\'s a scam and will give them access to ParagonPlus system.',"color: red; font-family: system-ui; font-size: 5rem; -webkit-text-stroke: 1px black; font-weight: bold;","font-family: system-ui; font-size: 1.75rem;")},set_long_term_cookie:function(e,t){var a=new Date;a.setTime(a.getTime()+31536e6),document.cookie=e+"="+t.toString()+";expires="+a+";path=/"},context_menu_program:function(){var a=$("html body nav.cm"),o=!1;function n(){o&&(a.css("box-shadow","none"),a.css("height","0px"),o=!1)}try{$("*").on("contextmenu",function(e){return function(e){n(),a.css("height","auto");var t=(t=e.pageX)+a.width()>=$(window).width()?$(window).width()-a.width():t,e=e.pageY-$(document).scrollTop();e-=e+a.height()>=$(window).height()?a.height():0,a.css("top",e.toString()+"px"),a.css("left",t.toString()+"px"),a.css("box-shadow","0px 0px 3.45px 2.3px rgba(0, 0, 0, 0.23)"),o=!0}(e),!1}),$(window).on("click scroll blur",n)}catch(e){}},getCookie:a,check_lang:function(){var e=a("set_lang");window.location.pathname.substr(1);null==e||""==e||null==e?(app.ui.change.lang("en",!1),self==top&&location.reload()):"en"==e?($("html body nav ul.nav li.back span").text("Back"),$("html body nav ul.nav li.reload span").text("Reload page"),$("html body nav ul.share li.copyurl span").text("Copy page URL"),$("html body nav ul.action li.print span").text("Print page")):"th"==e&&($("html body nav ul.nav li.back span").text("ย้อนกลับ"),$("html body nav ul.nav li.reload span").text("โหลดใหม่"),$("html body nav ul.share li.copyurl span").text("คัดลอกลิ้งก์"),$("html body nav ul.action li.print span").text("ปริ้นท์หน้านี้"))},check_theme:function(t=!0){setTimeout(function(){var e=a("set_theme");null==e||""==e||null==e?(app.ui.change.theme("light",!1),self==top&&location.reload()):"light"!=e||t?"dark"==e&&($("html head style.main").text($("html head style.main").text()+'\n:root,[data-dark="false"],.player,iframe{filter:invert(100%)hue-rotate(180deg);}\n'),$("html body header section div.head-item.clrt a").attr("href","javascript:app.ui.change.theme('light')"),$('html head meta[name="theme-color"]').attr("content","#8CC0FF"),$('html head meta[name="apple-mobile-web-app-status-bar-style"]').attr("content","#8CC0FF")):($("html head style.main").text($("html head style.main").text().substring(0,$("html head style.main").text().length-82)),$("html body header section div.head-item.clrt a").attr("href","javascript:app.ui.change.theme('dark')"),$('html head meta[name="theme-color"]').attr("content","#15499A"),$('html head meta[name="apple-mobile-web-app-status-bar-style"]').attr("content","#15499A"))},t?575:0)},stopPrntScr:o,fm_clrsrc:["done","info","warn","error"],write_loc_href:function(){$("html body nav.rfr").text(location.hostname+("/"==location.pathname?"":location.pathname))},color_up_codes:function(){document.querySelectorAll("code").forEach(e=>{var t=e.innerHTML,a=$(e).attr("lang");if("html"==a)t=t.replace(new RegExp("&","g"),"&amp;").replace(new RegExp("<","g"),"&lt;"),Prism.highlightElement(e,Prism.languages.html,"html");else if("css"==a)Prism.highlightElement(e,Prism.languages.css,"css");else if("js"==a){try{t.match(/^\/\/.*\n$/g).forEach(e=>{t=t.replace(new RegExp(e,"g"),e.fontcolor("var(--clr-pp-amber-300)"))})}catch(e){}try{t.match(/^("|").*("|")$/g).forEach(e=>{t=t.replace(new RegExp(e,"g"),e.fontcolor("var(--clr-pp-amber-300)"))})}catch(e){}e.innerHTML=e.innerHTML.replace(/<br>/g," enil0wen0 "),Prism.highlightElement(e,Prism.languages.javascript,"javascript")}})},clean_up_codes:function(){var t=setInterval(function(){document.querySelectorAll("code").forEach(e=>{"js"==$(e).attr("lang")&&(e.innerHTML=e.innerHTML.replace(/ enil0wen0 /g,"<br>"),e.innerHTML=e.innerHTML.replace(/ \*\//g,""),e.innerHTML=e.innerHTML.replace(/\/\*/g,"//"),!/( enil0wen0 | \*\/|\/\*)/g.test(e.innerHTML))||clearInterval(t)})},500);setTimeout(function(){clearInterval(t)},5e3)},ctrling:t}}var ppa=private();function initial_app(){function e(e){var t=$("html body header section div.head-item.menu a"),a=$("html body main"),o=$("html body header section div.head-item.ptmn div.action-btns");"navtab"==e?(ppa.set_long_term_cookie("sui_open-nt","false"==t.attr("opened")),t.attr("opened","false"==t.attr("opened")?"true":"false"),a.attr("shrink","false"==a.attr("shrink")?"true":"false"),setTimeout(function(){$(window).trigger("resize")},500)):"qckmnu"==e&&o.attr("expanded","false"==o.attr("expanded")?"true":"false")}function t(e,t=!0){var a=new Date;a.setTime(a.getTime()+31536e6),document.cookie="set_lang="+e+";expires="+a+";path=/",t&&ppa.check_lang()}function a(){var e=$("html body section.modal");e.fadeOut(500,function(){e.removeAttr("show"),e.removeAttr("style"),$("html body section.modal span.ctxt").html(""),document.querySelector("html body section.modal div span:last-child").innerHTML='<a role="button" class="filled"></a>'}),i.showing=!1}function o(t=!1){"Notification"in window?"denied"!==Notification.permission?Notification.requestPermission().then(function(e){if("object"==typeof t)return l(t),"granted"===Notification.permission}):app.ui.notify(1,[1,"Notification permission is already satisfied"]):app.ui.notify(1,[3,"Your browser doesn't support desktop notification"])}var n=function(e,t){var a,o=$("html body aside.fm");0==e?$(t).fadeOut(500,function(){$(t).css("filter","opacity(0)"),$(t).css("display","block"),$(t).css("min-height","0px"),$(t).animate({height:0,padding:0},250,"swing",function(){$(t).remove()})}):1==e&&(a=$('<div class="msg '+ppa.fm_clrsrc[t[0]]+'"><div onClick="app.ui.notify(0,this.parentNode)">⨯</div><img src="/reg/resource/images/fm-'+ppa.fm_clrsrc[t[0]]+'.png"><label>'+t[1]+"</label></div>"),o.append(a),a.data("timeout",{x:setTimeout(function(){n(0,a)},25e3)}),a.height(a.children().last().height()),o.animate({scrollTop:o.height()},1e3))},i={showing:!1,cfx:null},r={showing:!1},l=function(e){var t=new Notification("TianTcl Site",{body:e.context,icon:void 0!==e.option&&void 0!==e.option.icon?e.option.icon:"/favicon.ico",dir:void 0!==e.option&&void 0!==e.option.dir?e.option.dir:"ltr",image:void 0!==e.option&&void 0!==e.option.image?e.option.image:void 0});void 0!==e.onclick&&(t.onclick=e.onclick),void 0!==e.option&&void 0!==e.option.timeout&&setTimeout(function(){t.close()},1e3*e.option.timeout)};return{ui:{toggle:{langes:function(){t("en"==getCookie("set_lang")?"th":"en")},navtab:function(){e("navtab")},qckmnu:function(){e("qckmnu")}},change:{lang:function(e){t(e)},theme:function(e){var t,a;t=e,a=!0,(e=new Date).setTime(e.getTime()+31536e6),document.cookie="set_theme="+t+";expires="+e+";path=/",a&&ppa.check_theme(!1)}},usage:{modal:function(){app.ui.lightbox.open("mid",{title:"ModalBox material usage",allowclose:!0,html:'<b>To open : </b>use <code lang="js" class="language-js">app.ui.modal.open(a,b);</code><br>&emsp;which contains the first parameter <code lang="js" class="language-js">a</code> as the message at the top of the box STRING typed <code lang="js" class="language-js">""</code> & the second parameter <code lang="js" class="language-js">b</code> as an JS object <code lang="js" class="language-js">{}</code> which contains attributes as so<br><code lang="js" class="language-js">/* for a normal action button */<br>name: "action button name"<br>href: "URL redirection or a javascript:fx call"<br><br>/* for a selectable options */<br>response: "confirm" /* a fixed attribute */<br>option: ["array","of","option","names"] /* name for each action buttons */<br>values: ["value","for","each","options"] /* which has to match the order of the option array (values can be both INT and STRING) */<br><br>/* for text inputs */<br>response: "string" /* a fixed attribute */<br>type: "input element type attribute value" /* eg: "text", "password", "number", "tel", "email", "url" */<br><br>/* for any initiation with response attribute */<br>cfx: function(res){ "callback function" } /* a function called after the options are chosed (a function must contain only 1 parameter for the value of the selected option) */</code><br><br><b>To close : </b>normally, after an interaction, a programmatically close is not required for the modal will automatically close itself, but if it was so, then use <code lang="js" class="language-js">app.ui.modal.close();</code>'})},lightbox:function(){app.ui.lightbox.open("mid",{title:"LightBox material usage",allowclose:!0,html:'<b>To open : </b>use <code lang="js" class="language-js">app.ui.lightbox.open(a,b);</code><br>&emsp;which contains the first parameter <code lang="js" class="language-js">a</code> as the position of the lightbox that can only be <code lang="js" class="language-js">"top"</code>, <code lang="js" class="language-js">"mid"</code> or <code lang="js" class="language-js">"btm"</code> (top middle bottom) & the second parameter <code lang="js" class="language-js">b</code> as a JS object <code lang="js" class="language-js">{}</code> which contains attributes as so<br><code lang="js" class="language-js">title: "Heading of the lightbox"<br>allowclose: true|false /* true allows user to force close with an "⨯" at the top right corner of the lightbox and false don\'t */<br>autoclose: integer|decimal /* the lightbox will automatically close after the inputted second(s) has passed */<br>html: \'HTML STRING\' /* what will be shown in the content part of lightbox */</code><br>&emsp;Please note that all of these attributes are optional, but it\'s not a good idea to leave <code lang="js" class="language-js">html</code> as a blank attribute, and be careful if you\'re leaving the <code lang="js" class="language-js">allowclose</code> blank|false it may cause the lightbox to not being able to close until the page reloads so maybe you want to add the attribute <code lang="js" class="language-js">autoclose</code> for safety<br><br><b>To close : </b>regularly users will be the ones to close it or the timeout set, but if you want it to be programmatically close, then use <code lang="js" class="language-js">app.ui.lightbox.close();</code>'})},notify:function(){app.ui.lightbox.open("mid",{title:"Notify material usage",allowclose:!0,html:'<b>To control : </b>use <code lang="js" class="language-js">app.ui.notify(a,b);</code><br>&emsp;which contains first parameter <code lang="js" class="language-js">a</code> as the command for <code lang="js" class="language-js">0</code> closes the notification and <code lang="js" class="language-js">1</code> instantiates a new one & the second parameter <code lang="js" class="language-js">b</code> depends on the first parameter as so<br><code lang="js" class="language-js">/* if the first parameter is 0 then the second parameter must be a htmlDOMobject to the message parent */<br>document.querySelector("div.msg")<br>/* if the first parameter is 1 then the second parameter must be an array "[]" which contains two child */<br>/* first one is a number from 0 - 3 which indicates the message priority as { 0: "done (green)",&emsp;1: "info (blue)",&emsp;2: "warn (yellow)",&emsp;3: "error (red)"} */<br>/* and the second one is the message contained in the <i>new</i> notification (must be a STRING) */</code><br>Please note that all notification will automatically close 25 seconds after their instantiation<br><br><b>Structure example : </b><code lang="js" class="language-js">app.ui.notify(1, [0, "Your changes has been saved"]);</code>&emsp;<button onClick="app.ui.notify(1,[0,\'Your changes has been saved\'])">Try</button>'})}},modal:{open:function(e,t){!function(e,a){if(!i.showing){if($("html body section.modal").attr("show","true"),$("html body section.modal span.ctxt").html(e),null==a.response)$("html body section.modal div span:last-child a:last-child").attr("data-text",a.name),$("html body section.modal div span:last-child a:last-child").attr("href",void 0!==a.href?a.href:"javascript:app.ui.modal.close()");else{if("confirm"==a.response){let e,t="";for(e=0;e<a.option.length-1;e++)t+='<a role="button" data-text="'+a.option[e]+'" href="javascript:app.ui.modal.confirm('+("number"==typeof a.values[e]?a.values[e].toString():"'"+a.values[e]+"'")+')"></a>';$("html body section.modal div span:last-child").prepend($(t)),$("html body section.modal div span:last-child a:last-child").attr("data-text",a.option[e]),$("html body section.modal div span:last-child a:last-child").attr("href","javascript:app.ui.modal.confirm("+("number"==typeof a.values[e]?a.values[e].toString():"'"+a.values[e]+"'")+")")}else"string"==a.response&&($("html body section.modal span.ctxt").text(e),$("html body section.modal div span:last-child a:last-child").attr("data-text","Submit"),$("html body section.modal div span:last-child a:last-child").attr("href","javascript:app.ui.modal.submit()"),$("html body section.modal span.ctxt").append($('<input name="modal-response" type="'+a.type+'" />')),setTimeout(function(){$('html body section.modal span.ctxt input[name="modal-response"]').focus()},1250));i.cfx=a.cfx}i.showing=!0}}(e,t)},close:a,confirm:function(e){e=e,a(),i.cfx(e),i.cfx=null},submit:function(){a(),i.cfx($('html body section.modal span.ctxt input[name="modal-response"]').val()),i.cfx=null}},lightbox:{open:function(e,t){e=e,t=t,r.showing||($("html body section.lightbox").attr("ding",e),e=$('<div class="content"></div>'),void 0===t.title&&!t.allowclose||e.append('<div class="head"><span class="txtoe">'+(void 0!==t.title?t.title:"")+"</span>"+(t.allowclose?'<label onClick="app.ui.lightbox.close()">⨯</label>':"")+"</div>"),void 0!==t.html&&e.append('<div class="body">'+t.html+"</div>"),$("html body section.lightbox div.displayer").append(e),void 0!==t.autoclose&&(r.autoclose=setTimeout(function(){app.ui.lightbox.close()},t.autoclose+1250)),disableScroll(),ppa.color_up_codes(),r.showing=!0,"light"==(t=ppa.getCookie("set_theme"))?($('html head meta[name="theme-color"]').attr("content","#051227"),$('html head meta[name="apple-mobile-web-app-status-bar-style"]').attr("content","#051227")):"dark"==t&&($('html head meta[name="theme-color"]').attr("content","#243146"),$('html head meta[name="apple-mobile-web-app-status-bar-style"]').attr("content","#243146")))},close:function(){var t=$("html body section.lightbox");t.attr("ded",t.attr("ding")),t.removeAttr("ding"),clearTimeout(r.autoclose),setTimeout(function(){t.removeAttr("ded"),$("html body section.lightbox div.displayer").html(""),enableScroll(),r.showing=!1;var e=ppa.getCookie("set_theme");"light"==e?($('html head meta[name="theme-color"]').attr("content","#15499A"),$('html head meta[name="apple-mobile-web-app-status-bar-style"]').attr("content","#15499A")):"dark"==e&&($('html head meta[name="theme-color"]').attr("content","#8CC0FF"),$('html head meta[name="apple-mobile-web-app-status-bar-style"]').attr("content","#8CC0FF"))},1250)}},notify:function(e,t){n(e,t)}},io:{warpto:function(e,t=!1,a=!1,o){!function(e,t=!1,a=!1,o){a?parent.document.location="/"+e:ppa.ctrling||t?window.open("/"+e):window.location="/"+e,smooth_scrolling(o)}(e,t,a,o)},confirm:function(e,t={}){!function(e,t={}){switch(e){case"leave":$(window).bind("beforeunload",function(){return""});break;case"download":confirm('Confirm your download of "'+t.app_name+'"')||($(t.me).attr("data-href",$(t.me).attr("href")),$(t.me).removeAttr("href"),setTimeout(function(){$(t.me).attr("href",$(t.me).attr("data-href")),$(t.me).removeAttr("data-href")},250));break;case"sbmt_frm":confirm("Please recheck your form data, you won't be able to come back and edit it later.\nAre you sure you want to submit the form now?")}}(e,t)},copy:{location:function(){const e=document.createElement("textarea");e.value=window.location.href,document.body.appendChild(e),e.select(),document.execCommand("copy"),document.body.removeChild(e),app.ui.notify(1,[0,"Page URL copied!"])}},notify:{permission:o,send:function(e){e=e,"granted"===Notification.permission?l(e):o(e)||app.ui.notify(1,[3,"We're unable to send you the notification for the permission is not granted"])}},scrollToTop:function(){$("html, html body").animate({scrollTop:0},500,"swing")}},sys:{auth:{check:function(){var e=/\/reg\/student\/$/.test(location.pathname);i.showing&&app.ui.modal.close(),app.ui.lightbox.open("top",{title:"เข้าสู่ระบบ",allowclose:e,html:'<style type="text/css">div.auth-wrapper { margin: 10px 0px; padding: 5px; } div.auth-wrapper > * { margin: 2.5px 0px; font-size: 20px; font-family: "THSarabunNew", serif; } div.auth-wrapper label { display: block; } div.auth-wrapper label span { cursor: pointer; color: var(--clr-pp-blue-grey-700); } div.auth-wrapper label span:hover { background-color: rgba(0, 0, 0, 0.125); } div.auth-wrapper input { border-radius: 3px; border: 1px solid var(--clr-bs-gray-dark); padding: 0px 10px; width: calc(100% - 22.5px); transition: var(--time-tst-fast); } div.auth-wrapper input:focus { box-shadow: 0 0 7.5px .125px var(--clr-bs-blue) } input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; } input[type=number] { -moz-appearance: textfield; } div.auth-wrapper button { margin-top: 20px; } div.auth-wrapper font { font-size: 15px; } div.auth-wrapper font a:link, div.auth-wrapper font a:visited { text-decoration: none; color: var(--clr-bd-light-blue) } div.auth-wrapper font a:hover, div.auth-wrapper font a:active { text-decoration: underline; color: var(--clr-bd-low-light-blue) } @media only screen and (max-width: 768px) { div.auth-wrapper > * { font-size: 12.5px; } div.auth-wrapper font { font-size: 12.5px; } }</style><div class="auth-wrapper"><label>รหัสประจำตัวนักเรียน (นักเรียนเดิม) / เลขประจำตัวผู้สอบ (นักเรียนใหม่)</label><input name="user" type="number" autofocus><br><label>รหัสผ่าน (นักเรียนเดิม) / เลขประจำตัวประชาชน 13 หลัก (นักเรียนใหม่)</label><input name="pass" type="password"><br><center><button class="blue" onClick="app.sys.auth.submit()">ค้นหาข้อมูล</button></center><br><center><font>'+(e?"":'<a href="/reg/student/">กลับสู่หน้าหลัก (นักเรียน)</a> | ')+'<a href="/reg/teacher/">เข้าสู่ระบบครู</a></font></center></div>'}),$("html body header section div.head-item.auth").hide(),$("html body header section div.head-item.menu aside.navigator_tab ul.so").hide(),$.ajax({url:"/reg/resource/appwork/unauth.php"}),/\/reg\/student\/admission\/$/.test(location.pathname)&&window.open_unconfirmed_form()},submit:function(){var e={u:$('section.lightbox input[name="user"]').val(),p:$('section.lightbox input[name="pass"]').val()};""==e.u.trim()||""==e.p.trim()?app.ui.notify(1,[2,"Please check your inputs.\nโปรดตรวจสอบข้อมูลการเข้าสู่ระบบ"]):(document.querySelector("div.auth-wrapper button").disabled=!0,$.post("/reg/student/auth.php",{username:e.u,password:e.p,zone:0},function(e,t){document.querySelector("div.auth-wrapper button").disabled=!1;e=JSON.parse(e);e.success?($("html body header section div.head-item.auth").show(),$("html body header section div.head-item.menu aside.navigator_tab ul.so").show(),app.ui.lightbox.close(),/\/reg\/student\/admission\/$/.test(location.pathname)&&window.refresh_statement()):app.ui.notify(1,e.reason)}))},tac:function(e=""){var a;a=e,app.ui.modal.open("Enter access code",{response:"string",type:"password",cfx:function(e){""!=e&&$.post("/reg/resource/appwork/override.php",{ac:e},function(e,t){JSON.parse(e).success?setTimeout(function(){app.ui.modal.open("Authorization name",{response:"string",type:"text",cfx:function(e){$.post("/reg/resource/appwork/override.php",{ac_name:e},function(e,t){location="/"+(""!=a?a:"reg/teacher/")})}})},500):(setTimeout(window.fac,500),app.ui.notify(1,[3,"Incorrect access code."]))})}})},teacher:function(){i.showing&&app.ui.modal.close(),app.ui.lightbox.open("top",{title:"เข้าสู่ระบบครูผู้สอน",allowclose:!0,html:'<style type="text/css">div.auth-wrapper { margin: 10px 0px; padding: 5px; } div.auth-wrapper > * { margin: 2.5px 0px; font-size: 20px; font-family: "THSarabunNew", serif; } div.auth-wrapper label { display: block; } div.auth-wrapper label span { cursor: pointer; color: var(--clr-pp-blue-grey-700); } div.auth-wrapper label span:hover { background-color: rgba(0, 0, 0, 0.125); } div.auth-wrapper input, div.auth-wrapper select { border-radius: 3px; border: 1px solid var(--clr-bs-gray-dark); padding: 0px 10px; width: calc(100% - 22.5px); transition: var(--time-tst-fast); } div.auth-wrapper input:focus, div.auth-wrapper select:focus { box-shadow: 0 0 7.5px .125px var(--clr-bs-blue) } div.auth-wrapper button { margin-top: 20px; } div.auth-wrapper font { font-size: 15px; } div.auth-wrapper font a:link, div.auth-wrapper font a:visited { text-decoration: none; color: var(--clr-bd-light-blue) } div.auth-wrapper font a:hover, div.auth-wrapper font a:active { text-decoration: underline; color: var(--clr-bd-low-light-blue) } @media only screen and (max-width: 768px) { div.auth-wrapper > * { font-size: 12.5px; } div.auth-wrapper font { font-size: 12.5px; } }</style><div class="auth-wrapper"><label>ชื่อผู้ใช้งาน</label><input name="user" type="text" autofocus><br><label>รหัสผ่าน</label><input name="pass" type="password"><br><label>ประเภทผู้ใช้งาน</label><select name="zone"><option value="1">ข้าราชการครู</option><option value="2">ครูอัตราจ้าง/บุคลากร</option></select><br><center><button class="blue" onClick="app.sys.auth.t_sbmt()">เข้าสู่ระบบ</button></center><br><center><font><a href="/reg/student/">เข้าสู่ระบบนักเรียน</a></font></center></div>'}),$.ajax({url:"/reg/resource/appwork/unauth.php?f=t"})},t_sbmt:function(e=""){var a;a=e,""==(e={u:$('section.lightbox input[name="user"]').val(),p:$('section.lightbox input[name="pass"]').val()}).u.trim()||""==e.p.trim()?app.ui.notify(1,[2,"Please check your inputs.\nโปรดตรวจสอบข้อมูลการเข้าสู่ระบบ"]):(document.querySelector("div.auth-wrapper button").disabled=!0,$.post("/reg/teacher/auth.php",{username:e.u,password:e.p,zone:parseInt(document.querySelector('section.lightbox select[name="zone"]').value)},function(e,t){document.querySelector("div.auth-wrapper button").disabled=!1,JSON.parse(e).success?($("html body header section div.head-item.auth").show(),$("html body header section div.head-item.menu aside.navigator_tab ul.so").show(),app.ui.lightbox.close(),location="/"+(""!=a?a:"reg/teacher/")):app.ui.notify(1,[3,"Incorrect username or password"])}))}}}}}$(document).ready(function(){ppa.context_menu_program(),ppa.write_loc_href(),Prism.hooks.add("complete",ppa.clean_up_codes)});var app=initial_app();