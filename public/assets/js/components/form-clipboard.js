class BasicForm{initClipboardBasic(){const n=document.getElementById("clipboard_example"),i=n.nextElementSibling;new ClipboardJS(i,{target:n,text:function(){return n.value}}).on("success",function(n){const e=i.innerHTML;"Copied!"!==i.innerHTML&&(i.innerHTML="Copied!",setTimeout(function(){i.innerHTML=e},3e3))})}initClipboardCut(){const n=document.getElementById("clipboard_cut"),i=n.nextElementSibling;new ClipboardJS(i,{target:n,text:function(){return n.innerText}}).on("success",function(n){const e=i.innerHTML;"Copied!"!==i.innerHTML&&(i.innerHTML="Copied!",setTimeout(function(){i.innerHTML=e},3e3))})}initClipboardText(){const i=document.getElementById("clipboard_text");new ClipboardJS(i).on("success",function(n){const e=i.innerHTML;"Copied!"!==i.innerHTML&&(i.innerHTML="Copied!",setTimeout(function(){i.innerHTML=e},3e3))})}init(){this.initClipboardBasic(),this.initClipboardCut(),this.initClipboardText()}}document.addEventListener("DOMContentLoaded",function(n){(new BasicForm).init()});