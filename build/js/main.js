!function(){"use strict";new class{constructor(){this.clientDetector()}clientDetector=()=>{var s="";if(screen.width){s+=(screen.width?screen.width:"")+" x "+(screen.height?screen.height:"")}var i,e,t,n=navigator.appVersion,a=navigator.userAgent,r=navigator.appName,o=""+parseFloat(navigator.appVersion),d=parseInt(navigator.appVersion,10);-1!=(e=a.indexOf("Opera"))&&(r="Opera",o=a.substring(e+6),-1!=(e=a.indexOf("Version"))&&(o=a.substring(e+8))),-1!=(e=a.indexOf("OPR"))?(r="Opera",o=a.substring(e+4)):-1!=(e=a.indexOf("Edge"))?(r="Microsoft Legacy Edge",o=a.substring(e+5)):-1!=(e=a.indexOf("Edg"))?(r="Microsoft Edge",o=a.substring(e+4)):-1!=(e=a.indexOf("MSIE"))?(r="Microsoft Internet Explorer",o=a.substring(e+5)):-1!=(e=a.indexOf("Chrome"))?(r="Chrome",o=a.substring(e+7)):-1!=(e=a.indexOf("Safari"))?(r="Safari",o=a.substring(e+7),-1!=(e=a.indexOf("Version"))&&(o=a.substring(e+8))):-1!=(e=a.indexOf("Firefox"))?(r="Firefox",o=a.substring(e+8)):-1!=a.indexOf("Trident/")?(r="Microsoft Internet Explorer",o=a.substring(a.indexOf("rv:")+3)):(i=a.lastIndexOf(" ")+1)<(e=a.lastIndexOf("/"))&&(r=a.substring(i,e),o=a.substring(e+1),r.toLowerCase()==r.toUpperCase()&&(r=navigator.appName)),-1!=(t=o.indexOf(";"))&&(o=o.substring(0,t)),-1!=(t=o.indexOf(" "))&&(o=o.substring(0,t)),-1!=(t=o.indexOf(")"))&&(o=o.substring(0,t)),d=parseInt(""+o,10),isNaN(d)&&(o=""+parseFloat(navigator.appVersion),d=parseInt(navigator.appVersion,10));var c=/Mobile|mini|Fennec|Android|iP(ad|od|hone)/.test(n),l=!!navigator.cookieEnabled;void 0!==navigator.cookieEnabled||l||(document.cookie="testcookie",l=-1!=document.cookie.indexOf("testcookie"));var g="-",w=[{s:"Windows 10",r:/(Windows 10.0|Windows NT 10.0)/},{s:"Windows 8.1",r:/(Windows 8.1|Windows NT 6.3)/},{s:"Windows 8",r:/(Windows 8|Windows NT 6.2)/},{s:"Windows 7",r:/(Windows 7|Windows NT 6.1)/},{s:"Windows Vista",r:/Windows NT 6.0/},{s:"Windows Server 2003",r:/Windows NT 5.2/},{s:"Windows XP",r:/(Windows NT 5.1|Windows XP)/},{s:"Windows 2000",r:/(Windows NT 5.0|Windows 2000)/},{s:"Windows ME",r:/(Win 9x 4.90|Windows ME)/},{s:"Windows 98",r:/(Windows 98|Win98)/},{s:"Windows 95",r:/(Windows 95|Win95|Windows_95)/},{s:"Windows NT 4.0",r:/(Windows NT 4.0|WinNT4.0|WinNT|Windows NT)/},{s:"Windows CE",r:/Windows CE/},{s:"Windows 3.11",r:/Win16/},{s:"Android",r:/Android/},{s:"Open BSD",r:/OpenBSD/},{s:"Sun OS",r:/SunOS/},{s:"Chrome OS",r:/CrOS/},{s:"Linux",r:/(Linux|X11(?!.*CrOS))/},{s:"iOS",r:/(iPhone|iPad|iPod)/},{s:"Mac OS X",r:/Mac OS X/},{s:"Mac OS",r:/(Mac OS|MacPPC|MacIntel|Mac_PowerPC|Macintosh)/},{s:"QNX",r:/QNX/},{s:"UNIX",r:/UNIX/},{s:"BeOS",r:/BeOS/},{s:"OS/2",r:/OS\/2/},{s:"Search Bot",r:/(nuhk|Googlebot|Yammybot|Openbot|Slurp|MSNBot|Ask Jeeves\/Teoma|ia_archiver)/}];for(var p in w){var b=w[p];if(b.r.test(a)){g=b.s;break}}var h="-";switch(/Windows/.test(g)&&(h=/Windows (.*)/.exec(g)[1],g="Windows"),g){case"Mac OS":case"Mac OS X":case"Android":h=/(?:Android|Mac OS|Mac OS X|MacPPC|MacIntel|Mac_PowerPC|Macintosh) ([\.\_\d]+)/.exec(a)[1];break;case"iOS":h=(h=/OS (\d+)_(\d+)_?(\d+)?/.exec(n))[1]+"."+h[2]+"."+(0|h[3])}var u="no check";if("undefined"!=typeof swfobject){var O=swfobject.getFlashPlayerVersion();u=O.major>0?O.major+"."+O.minor+" r"+O.release:"-"}window.jscd={screen:s,browser:r,browserVersion:o,browserMajorVersion:d,mobile:c,os:g,osVersion:h,cookies:l,flashVersion:u}}},new class{constructor(){this.tabs=[...document.getElementsByClassName("navigation__item--button")],this.table=document.getElementById("graella"),this.init()}init=()=>{this.tabs.forEach((s=>{s.addEventListener("click",(()=>{const i=s.getAttribute("day-target");this.tabs.forEach((s=>{s.classList.remove("active")})),s.classList.toggle("active"),this.table.className="",this.table.classList.add("graella"),this.table.classList.add(i)}))}))}},new class{constructor(){this.playpause_btn=document.getElementById("contrabanda_playpause"),this.stream_src=this.playpause_btn.getAttribute("data-url"),this.isPlaying=!1,this.contrabandaAudio=new Audio(this.stream_src),this.init()}init=()=>{this.playpause_btn.addEventListener("click",(()=>this.playpauseStream()))};playpauseStream=()=>{jscd.mobile?window.location.href=this.stream_src:this.isPlaying?this.stopStream():this.playStream()};playStream=()=>{this.contrabandaAudio.play(),this.isPlaying=!0,this.toggleClasses()};stopStream=()=>{this.contrabandaAudio.pause(),this.isPlaying=!1,this.toggleClasses()};toggleClasses=()=>{this.playpause_btn.classList.toggle("contrabanda-player__button--play"),this.playpause_btn.classList.toggle("contrabanda-player__button--pause")}}}();