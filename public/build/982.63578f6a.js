(self.webpackChunk=self.webpackChunk||[]).push([[982],{5787:(e,t,r)=>{var n=r(7854),a=r(7976),s=n.TypeError;e.exports=function(e,t){if(a(t,e))return e;throw s("Incorrect invocation")}},8533:(e,t,r)=>{"use strict";var n=r(2092).forEach,a=r(9341)("forEach");e.exports=a?[].forEach:function(e){return n(this,e,arguments.length>1?arguments[1]:void 0)}},8457:(e,t,r)=>{"use strict";var n=r(7854),a=r(9974),s=r(6916),i=r(7908),o=r(3411),u=r(7659),h=r(4411),f=r(6244),c=r(6135),l=r(8554),p=r(1246),g=n.Array;e.exports=function(e){var t=i(e),r=h(this),n=arguments.length,v=n>1?arguments[1]:void 0,m=void 0!==v;m&&(v=a(v,n>2?arguments[2]:void 0));var d,y,w,b,U,P,k=p(t),R=0;if(!k||this==g&&u(k))for(d=f(t),y=r?new this(d):g(d);d>R;R++)P=m?v(t[R],R):t[R],c(y,R,P);else for(U=(b=l(t,k)).next,y=r?new this:[];!(w=s(U,b)).done;R++)P=m?o(b,v,[w.value,R],!0):w.value,c(y,R,P);return y.length=R,y}},9341:(e,t,r)=>{"use strict";var n=r(7293);e.exports=function(e,t){var r=[][e];return!!r&&n((function(){r.call(null,t||function(){return 1},1)}))}},4362:(e,t,r)=>{var n=r(1589),a=Math.floor,s=function(e,t){var r=e.length,u=a(r/2);return r<8?i(e,t):o(e,s(n(e,0,u),t),s(n(e,u),t),t)},i=function(e,t){for(var r,n,a=e.length,s=1;s<a;){for(n=s,r=e[s];n&&t(e[n-1],r)>0;)e[n]=e[--n];n!==s++&&(e[n]=r)}return e},o=function(e,t,r,n){for(var a=t.length,s=r.length,i=0,o=0;i<a||o<s;)e[i+o]=i<a&&o<s?n(t[i],r[o])<=0?t[i++]:r[o++]:i<a?t[i++]:r[o++];return e};e.exports=s},3411:(e,t,r)=>{var n=r(9670),a=r(9212);e.exports=function(e,t,r,s){try{return s?t(n(r)[0],r[1]):t(r)}catch(t){a(e,"throw",t)}}},1246:(e,t,r)=>{var n=r(648),a=r(8173),s=r(7497),i=r(5112)("iterator");e.exports=function(e){if(null!=e)return a(e,i)||a(e,"@@iterator")||s[n(e)]}},8554:(e,t,r)=>{var n=r(7854),a=r(6916),s=r(9662),i=r(9670),o=r(6330),u=r(1246),h=n.TypeError;e.exports=function(e,t){var r=arguments.length<2?u(e):t;if(s(r))return i(a(r,e));throw h(o(e)+" is not iterable")}},7659:(e,t,r)=>{var n=r(5112),a=r(7497),s=n("iterator"),i=Array.prototype;e.exports=function(e){return void 0!==e&&(a.Array===e||i[s]===e)}},9212:(e,t,r)=>{var n=r(6916),a=r(9670),s=r(8173);e.exports=function(e,t,r){var i,o;a(e);try{if(!(i=s(e,"return"))){if("throw"===t)throw r;return r}i=n(i,e)}catch(e){o=!0,i=e}if("throw"===t)throw r;if(o)throw i;return a(i),r}},590:(e,t,r)=>{var n=r(7293),a=r(5112),s=r(1913),i=a("iterator");e.exports=!n((function(){var e=new URL("b?a=1&b=2&c=3","http://a"),t=e.searchParams,r="";return e.pathname="c%20d",t.forEach((function(e,n){t.delete("b"),r+=n+e})),s&&!e.toJSON||!t.sort||"http://a/c%20d?a=1&c=3"!==e.href||"3"!==t.get("c")||"a=1"!==String(new URLSearchParams("?a=1"))||!t[i]||"a"!==new URL("https://a@b").username||"b"!==new URLSearchParams(new URLSearchParams("a=b")).get("a")||"xn--e1aybc"!==new URL("http://тест").host||"#%D0%B1"!==new URL("http://a#б").hash||"a1c3"!==r||"x"!==new URL("http://x",void 0).host}))},1574:(e,t,r)=>{"use strict";var n=r(9781),a=r(1702),s=r(6916),i=r(7293),o=r(1956),u=r(5181),h=r(5296),f=r(7908),c=r(8361),l=Object.assign,p=Object.defineProperty,g=a([].concat);e.exports=!l||i((function(){if(n&&1!==l({b:1},l(p({},"a",{enumerable:!0,get:function(){p(this,"b",{value:3,enumerable:!1})}}),{b:2})).b)return!0;var e={},t={},r=Symbol(),a="abcdefghijklmnopqrst";return e[r]=7,a.split("").forEach((function(e){t[e]=e})),7!=l({},e)[r]||o(l({},t)).join("")!=a}))?function(e,t){for(var r=f(e),a=arguments.length,i=1,l=u.f,p=h.f;a>i;)for(var v,m=c(arguments[i++]),d=l?g(o(m),l(m)):o(m),y=d.length,w=0;y>w;)v=d[w++],n&&!s(p,m,v)||(r[v]=m[v]);return r}:l},2248:(e,t,r)=>{var n=r(1320);e.exports=function(e,t,r){for(var a in t)n(e,a,t[a],r);return e}},3197:(e,t,r)=>{"use strict";var n=r(7854),a=r(1702),s=2147483647,i=/[^\0-\u007E]/,o=/[.\u3002\uFF0E\uFF61]/g,u="Overflow: input needs wider integers to process",h=n.RangeError,f=a(o.exec),c=Math.floor,l=String.fromCharCode,p=a("".charCodeAt),g=a([].join),v=a([].push),m=a("".replace),d=a("".split),y=a("".toLowerCase),w=function(e){return e+22+75*(e<26)},b=function(e,t,r){var n=0;for(e=r?c(e/700):e>>1,e+=c(e/t);e>455;)e=c(e/35),n+=36;return c(n+36*e/(e+38))},U=function(e){var t=[];e=function(e){for(var t=[],r=0,n=e.length;r<n;){var a=p(e,r++);if(a>=55296&&a<=56319&&r<n){var s=p(e,r++);56320==(64512&s)?v(t,((1023&a)<<10)+(1023&s)+65536):(v(t,a),r--)}else v(t,a)}return t}(e);var r,n,a=e.length,i=128,o=0,f=72;for(r=0;r<e.length;r++)(n=e[r])<128&&v(t,l(n));var m=t.length,d=m;for(m&&v(t,"-");d<a;){var y=s;for(r=0;r<e.length;r++)(n=e[r])>=i&&n<y&&(y=n);var U=d+1;if(y-i>c((s-o)/U))throw h(u);for(o+=(y-i)*U,i=y,r=0;r<e.length;r++){if((n=e[r])<i&&++o>s)throw h(u);if(n==i){for(var P=o,k=36;;){var R=k<=f?1:k>=f+26?26:k-f;if(P<R)break;var S=P-R,L=36-R;v(t,l(w(R+S%L))),P=c(S/L),k+=36}v(t,l(w(P))),f=b(o,U,d==m),o=0,d++}}o++,i++}return g(t,"")};e.exports=function(e){var t,r,n=[],a=d(m(y(e),o,"."),".");for(t=0;t<a.length;t++)r=a[t],v(n,f(i,r)?"xn--"+U(r):r);return g(n,".")}},8053:(e,t,r)=>{var n=r(7854).TypeError;e.exports=function(e,t){if(e<t)throw n("Not enough arguments");return e}},9554:(e,t,r)=>{"use strict";var n=r(2109),a=r(8533);n({target:"Array",proto:!0,forced:[].forEach!=a},{forEach:a})},2564:(e,t,r)=>{var n=r(2109),a=r(7854),s=r(2104),i=r(614),o=r(8113),u=r(206),h=r(8053),f=/MSIE .\./.test(o),c=a.Function,l=function(e){return function(t,r){var n=h(arguments.length,1)>2,a=i(t)?t:c(t),o=n?u(arguments,2):void 0;return e(n?function(){s(a,this,o)}:a,r)}};n({global:!0,bind:!0,forced:f},{setTimeout:l(a.setTimeout),setInterval:l(a.setInterval)})},1637:(e,t,r)=>{"use strict";r(6992);var n=r(2109),a=r(7854),s=r(5005),i=r(6916),o=r(1702),u=r(590),h=r(1320),f=r(2248),c=r(8003),l=r(4994),p=r(9909),g=r(5787),v=r(614),m=r(2597),d=r(9974),y=r(648),w=r(9670),b=r(111),U=r(1340),P=r(30),k=r(9114),R=r(8554),S=r(1246),L=r(8053),x=r(5112),q=r(4362),H=x("iterator"),B="URLSearchParams",A="URLSearchParamsIterator",E=p.set,j=p.getterFor(B),C=p.getterFor(A),I=s("fetch"),O=s("Request"),z=s("Headers"),F=O&&O.prototype,T=z&&z.prototype,M=a.RegExp,$=a.TypeError,N=a.decodeURIComponent,Q=a.encodeURIComponent,J=o("".charAt),D=o([].join),G=o([].push),K=o("".replace),V=o([].shift),W=o([].splice),X=o("".split),Y=o("".slice),Z=/\+/g,_=Array(4),ee=function(e){return _[e-1]||(_[e-1]=M("((?:%[\\da-f]{2}){"+e+"})","gi"))},te=function(e){try{return N(e)}catch(t){return e}},re=function(e){var t=K(e,Z," "),r=4;try{return N(t)}catch(e){for(;r;)t=K(t,ee(r--),te);return t}},ne=/[!'()~]|%20/g,ae={"!":"%21","'":"%27","(":"%28",")":"%29","~":"%7E","%20":"+"},se=function(e){return ae[e]},ie=function(e){return K(Q(e),ne,se)},oe=l((function(e,t){E(this,{type:A,iterator:R(j(e).entries),kind:t})}),"Iterator",(function(){var e=C(this),t=e.kind,r=e.iterator.next(),n=r.value;return r.done||(r.value="keys"===t?n.key:"values"===t?n.value:[n.key,n.value]),r}),!0),ue=function(e){this.entries=[],this.url=null,void 0!==e&&(b(e)?this.parseObject(e):this.parseQuery("string"==typeof e?"?"===J(e,0)?Y(e,1):e:U(e)))};ue.prototype={type:B,bindURL:function(e){this.url=e,this.update()},parseObject:function(e){var t,r,n,a,s,o,u,h=S(e);if(h)for(r=(t=R(e,h)).next;!(n=i(r,t)).done;){if(s=(a=R(w(n.value))).next,(o=i(s,a)).done||(u=i(s,a)).done||!i(s,a).done)throw $("Expected sequence with length 2");G(this.entries,{key:U(o.value),value:U(u.value)})}else for(var f in e)m(e,f)&&G(this.entries,{key:f,value:U(e[f])})},parseQuery:function(e){if(e)for(var t,r,n=X(e,"&"),a=0;a<n.length;)(t=n[a++]).length&&(r=X(t,"="),G(this.entries,{key:re(V(r)),value:re(D(r,"="))}))},serialize:function(){for(var e,t=this.entries,r=[],n=0;n<t.length;)e=t[n++],G(r,ie(e.key)+"="+ie(e.value));return D(r,"&")},update:function(){this.entries.length=0,this.parseQuery(this.url.query)},updateURL:function(){this.url&&this.url.update()}};var he=function(){g(this,fe);var e=arguments.length>0?arguments[0]:void 0;E(this,new ue(e))},fe=he.prototype;if(f(fe,{append:function(e,t){L(arguments.length,2);var r=j(this);G(r.entries,{key:U(e),value:U(t)}),r.updateURL()},delete:function(e){L(arguments.length,1);for(var t=j(this),r=t.entries,n=U(e),a=0;a<r.length;)r[a].key===n?W(r,a,1):a++;t.updateURL()},get:function(e){L(arguments.length,1);for(var t=j(this).entries,r=U(e),n=0;n<t.length;n++)if(t[n].key===r)return t[n].value;return null},getAll:function(e){L(arguments.length,1);for(var t=j(this).entries,r=U(e),n=[],a=0;a<t.length;a++)t[a].key===r&&G(n,t[a].value);return n},has:function(e){L(arguments.length,1);for(var t=j(this).entries,r=U(e),n=0;n<t.length;)if(t[n++].key===r)return!0;return!1},set:function(e,t){L(arguments.length,1);for(var r,n=j(this),a=n.entries,s=!1,i=U(e),o=U(t),u=0;u<a.length;u++)(r=a[u]).key===i&&(s?W(a,u--,1):(s=!0,r.value=o));s||G(a,{key:i,value:o}),n.updateURL()},sort:function(){var e=j(this);q(e.entries,(function(e,t){return e.key>t.key?1:-1})),e.updateURL()},forEach:function(e){for(var t,r=j(this).entries,n=d(e,arguments.length>1?arguments[1]:void 0),a=0;a<r.length;)n((t=r[a++]).value,t.key,this)},keys:function(){return new oe(this,"keys")},values:function(){return new oe(this,"values")},entries:function(){return new oe(this,"entries")}},{enumerable:!0}),h(fe,H,fe.entries,{name:"entries"}),h(fe,"toString",(function(){return j(this).serialize()}),{enumerable:!0}),c(he,B),n({global:!0,forced:!u},{URLSearchParams:he}),!u&&v(z)){var ce=o(T.has),le=o(T.set),pe=function(e){if(b(e)){var t,r=e.body;if(y(r)===B)return t=e.headers?new z(e.headers):new z,ce(t,"content-type")||le(t,"content-type","application/x-www-form-urlencoded;charset=UTF-8"),P(e,{body:k(0,U(r)),headers:k(0,t)})}return e};if(v(I)&&n({global:!0,enumerable:!0,forced:!0},{fetch:function(e){return I(e,arguments.length>1?pe(arguments[1]):{})}}),v(O)){var ge=function(e){return g(this,F),new O(e,arguments.length>1?pe(arguments[1]):{})};F.constructor=ge,ge.prototype=F,n({global:!0,forced:!0},{Request:ge})}}e.exports={URLSearchParams:he,getState:j}},285:(e,t,r)=>{"use strict";r(8783);var n,a=r(2109),s=r(9781),i=r(590),o=r(7854),u=r(9974),h=r(1702),f=r(6048).f,c=r(1320),l=r(5787),p=r(2597),g=r(1574),v=r(8457),m=r(1589),d=r(8710).codeAt,y=r(3197),w=r(1340),b=r(8003),U=r(8053),P=r(1637),k=r(9909),R=k.set,S=k.getterFor("URL"),L=P.URLSearchParams,x=P.getState,q=o.URL,H=o.TypeError,B=o.parseInt,A=Math.floor,E=Math.pow,j=h("".charAt),C=h(/./.exec),I=h([].join),O=h(1..toString),z=h([].pop),F=h([].push),T=h("".replace),M=h([].shift),$=h("".split),N=h("".slice),Q=h("".toLowerCase),J=h([].unshift),D="Invalid scheme",G="Invalid host",K="Invalid port",V=/[a-z]/i,W=/[\d+-.a-z]/i,X=/\d/,Y=/^0x/i,Z=/^[0-7]+$/,_=/^\d+$/,ee=/^[\da-f]+$/i,te=/[\0\t\n\r #%/:<>?@[\\\]^|]/,re=/[\0\t\n\r #/:<>?@[\\\]^|]/,ne=/^[\u0000-\u0020]+|[\u0000-\u0020]+$/g,ae=/[\t\n\r]/g,se=function(e){var t,r,n,a;if("number"==typeof e){for(t=[],r=0;r<4;r++)J(t,e%256),e=A(e/256);return I(t,".")}if("object"==typeof e){for(t="",n=function(e){for(var t=null,r=1,n=null,a=0,s=0;s<8;s++)0!==e[s]?(a>r&&(t=n,r=a),n=null,a=0):(null===n&&(n=s),++a);return a>r&&(t=n,r=a),t}(e),r=0;r<8;r++)a&&0===e[r]||(a&&(a=!1),n===r?(t+=r?":":"::",a=!0):(t+=O(e[r],16),r<7&&(t+=":")));return"["+t+"]"}return e},ie={},oe=g({},ie,{" ":1,'"':1,"<":1,">":1,"`":1}),ue=g({},oe,{"#":1,"?":1,"{":1,"}":1}),he=g({},ue,{"/":1,":":1,";":1,"=":1,"@":1,"[":1,"\\":1,"]":1,"^":1,"|":1}),fe=function(e,t){var r=d(e,0);return r>32&&r<127&&!p(t,e)?e:encodeURIComponent(e)},ce={ftp:21,file:null,http:80,https:443,ws:80,wss:443},le=function(e,t){var r;return 2==e.length&&C(V,j(e,0))&&(":"==(r=j(e,1))||!t&&"|"==r)},pe=function(e){var t;return e.length>1&&le(N(e,0,2))&&(2==e.length||"/"===(t=j(e,2))||"\\"===t||"?"===t||"#"===t)},ge=function(e){return"."===e||"%2e"===Q(e)},ve={},me={},de={},ye={},we={},be={},Ue={},Pe={},ke={},Re={},Se={},Le={},xe={},qe={},He={},Be={},Ae={},Ee={},je={},Ce={},Ie={},Oe=function(e,t,r){var n,a,s,i=w(e);if(t){if(a=this.parse(i))throw H(a);this.searchParams=null}else{if(void 0!==r&&(n=new Oe(r,!0)),a=this.parse(i,null,n))throw H(a);(s=x(new L)).bindURL(this),this.searchParams=s}};Oe.prototype={type:"URL",parse:function(e,t,r){var a,s,i,o,u,h=this,f=t||ve,c=0,l="",g=!1,d=!1,y=!1;for(e=w(e),t||(h.scheme="",h.username="",h.password="",h.host=null,h.port=null,h.path=[],h.query=null,h.fragment=null,h.cannotBeABaseURL=!1,e=T(e,ne,"")),e=T(e,ae,""),a=v(e);c<=a.length;){switch(s=a[c],f){case ve:if(!s||!C(V,s)){if(t)return D;f=de;continue}l+=Q(s),f=me;break;case me:if(s&&(C(W,s)||"+"==s||"-"==s||"."==s))l+=Q(s);else{if(":"!=s){if(t)return D;l="",f=de,c=0;continue}if(t&&(h.isSpecial()!=p(ce,l)||"file"==l&&(h.includesCredentials()||null!==h.port)||"file"==h.scheme&&!h.host))return;if(h.scheme=l,t)return void(h.isSpecial()&&ce[h.scheme]==h.port&&(h.port=null));l="","file"==h.scheme?f=qe:h.isSpecial()&&r&&r.scheme==h.scheme?f=ye:h.isSpecial()?f=Pe:"/"==a[c+1]?(f=we,c++):(h.cannotBeABaseURL=!0,F(h.path,""),f=je)}break;case de:if(!r||r.cannotBeABaseURL&&"#"!=s)return D;if(r.cannotBeABaseURL&&"#"==s){h.scheme=r.scheme,h.path=m(r.path),h.query=r.query,h.fragment="",h.cannotBeABaseURL=!0,f=Ie;break}f="file"==r.scheme?qe:be;continue;case ye:if("/"!=s||"/"!=a[c+1]){f=be;continue}f=ke,c++;break;case we:if("/"==s){f=Re;break}f=Ee;continue;case be:if(h.scheme=r.scheme,s==n)h.username=r.username,h.password=r.password,h.host=r.host,h.port=r.port,h.path=m(r.path),h.query=r.query;else if("/"==s||"\\"==s&&h.isSpecial())f=Ue;else if("?"==s)h.username=r.username,h.password=r.password,h.host=r.host,h.port=r.port,h.path=m(r.path),h.query="",f=Ce;else{if("#"!=s){h.username=r.username,h.password=r.password,h.host=r.host,h.port=r.port,h.path=m(r.path),h.path.length--,f=Ee;continue}h.username=r.username,h.password=r.password,h.host=r.host,h.port=r.port,h.path=m(r.path),h.query=r.query,h.fragment="",f=Ie}break;case Ue:if(!h.isSpecial()||"/"!=s&&"\\"!=s){if("/"!=s){h.username=r.username,h.password=r.password,h.host=r.host,h.port=r.port,f=Ee;continue}f=Re}else f=ke;break;case Pe:if(f=ke,"/"!=s||"/"!=j(l,c+1))continue;c++;break;case ke:if("/"!=s&&"\\"!=s){f=Re;continue}break;case Re:if("@"==s){g&&(l="%40"+l),g=!0,i=v(l);for(var b=0;b<i.length;b++){var U=i[b];if(":"!=U||y){var P=fe(U,he);y?h.password+=P:h.username+=P}else y=!0}l=""}else if(s==n||"/"==s||"?"==s||"#"==s||"\\"==s&&h.isSpecial()){if(g&&""==l)return"Invalid authority";c-=v(l).length+1,l="",f=Se}else l+=s;break;case Se:case Le:if(t&&"file"==h.scheme){f=Be;continue}if(":"!=s||d){if(s==n||"/"==s||"?"==s||"#"==s||"\\"==s&&h.isSpecial()){if(h.isSpecial()&&""==l)return G;if(t&&""==l&&(h.includesCredentials()||null!==h.port))return;if(o=h.parseHost(l))return o;if(l="",f=Ae,t)return;continue}"["==s?d=!0:"]"==s&&(d=!1),l+=s}else{if(""==l)return G;if(o=h.parseHost(l))return o;if(l="",f=xe,t==Le)return}break;case xe:if(!C(X,s)){if(s==n||"/"==s||"?"==s||"#"==s||"\\"==s&&h.isSpecial()||t){if(""!=l){var k=B(l,10);if(k>65535)return K;h.port=h.isSpecial()&&k===ce[h.scheme]?null:k,l=""}if(t)return;f=Ae;continue}return K}l+=s;break;case qe:if(h.scheme="file","/"==s||"\\"==s)f=He;else{if(!r||"file"!=r.scheme){f=Ee;continue}if(s==n)h.host=r.host,h.path=m(r.path),h.query=r.query;else if("?"==s)h.host=r.host,h.path=m(r.path),h.query="",f=Ce;else{if("#"!=s){pe(I(m(a,c),""))||(h.host=r.host,h.path=m(r.path),h.shortenPath()),f=Ee;continue}h.host=r.host,h.path=m(r.path),h.query=r.query,h.fragment="",f=Ie}}break;case He:if("/"==s||"\\"==s){f=Be;break}r&&"file"==r.scheme&&!pe(I(m(a,c),""))&&(le(r.path[0],!0)?F(h.path,r.path[0]):h.host=r.host),f=Ee;continue;case Be:if(s==n||"/"==s||"\\"==s||"?"==s||"#"==s){if(!t&&le(l))f=Ee;else if(""==l){if(h.host="",t)return;f=Ae}else{if(o=h.parseHost(l))return o;if("localhost"==h.host&&(h.host=""),t)return;l="",f=Ae}continue}l+=s;break;case Ae:if(h.isSpecial()){if(f=Ee,"/"!=s&&"\\"!=s)continue}else if(t||"?"!=s)if(t||"#"!=s){if(s!=n&&(f=Ee,"/"!=s))continue}else h.fragment="",f=Ie;else h.query="",f=Ce;break;case Ee:if(s==n||"/"==s||"\\"==s&&h.isSpecial()||!t&&("?"==s||"#"==s)){if(".."===(u=Q(u=l))||"%2e."===u||".%2e"===u||"%2e%2e"===u?(h.shortenPath(),"/"==s||"\\"==s&&h.isSpecial()||F(h.path,"")):ge(l)?"/"==s||"\\"==s&&h.isSpecial()||F(h.path,""):("file"==h.scheme&&!h.path.length&&le(l)&&(h.host&&(h.host=""),l=j(l,0)+":"),F(h.path,l)),l="","file"==h.scheme&&(s==n||"?"==s||"#"==s))for(;h.path.length>1&&""===h.path[0];)M(h.path);"?"==s?(h.query="",f=Ce):"#"==s&&(h.fragment="",f=Ie)}else l+=fe(s,ue);break;case je:"?"==s?(h.query="",f=Ce):"#"==s?(h.fragment="",f=Ie):s!=n&&(h.path[0]+=fe(s,ie));break;case Ce:t||"#"!=s?s!=n&&("'"==s&&h.isSpecial()?h.query+="%27":h.query+="#"==s?"%23":fe(s,ie)):(h.fragment="",f=Ie);break;case Ie:s!=n&&(h.fragment+=fe(s,oe))}c++}},parseHost:function(e){var t,r,n;if("["==j(e,0)){if("]"!=j(e,e.length-1))return G;if(t=function(e){var t,r,n,a,s,i,o,u=[0,0,0,0,0,0,0,0],h=0,f=null,c=0,l=function(){return j(e,c)};if(":"==l()){if(":"!=j(e,1))return;c+=2,f=++h}for(;l();){if(8==h)return;if(":"!=l()){for(t=r=0;r<4&&C(ee,l());)t=16*t+B(l(),16),c++,r++;if("."==l()){if(0==r)return;if(c-=r,h>6)return;for(n=0;l();){if(a=null,n>0){if(!("."==l()&&n<4))return;c++}if(!C(X,l()))return;for(;C(X,l());){if(s=B(l(),10),null===a)a=s;else{if(0==a)return;a=10*a+s}if(a>255)return;c++}u[h]=256*u[h]+a,2!=++n&&4!=n||h++}if(4!=n)return;break}if(":"==l()){if(c++,!l())return}else if(l())return;u[h++]=t}else{if(null!==f)return;c++,f=++h}}if(null!==f)for(i=h-f,h=7;0!=h&&i>0;)o=u[h],u[h--]=u[f+i-1],u[f+--i]=o;else if(8!=h)return;return u}(N(e,1,-1)),!t)return G;this.host=t}else if(this.isSpecial()){if(e=y(e),C(te,e))return G;if(t=function(e){var t,r,n,a,s,i,o,u=$(e,".");if(u.length&&""==u[u.length-1]&&u.length--,(t=u.length)>4)return e;for(r=[],n=0;n<t;n++){if(""==(a=u[n]))return e;if(s=10,a.length>1&&"0"==j(a,0)&&(s=C(Y,a)?16:8,a=N(a,8==s?1:2)),""===a)i=0;else{if(!C(10==s?_:8==s?Z:ee,a))return e;i=B(a,s)}F(r,i)}for(n=0;n<t;n++)if(i=r[n],n==t-1){if(i>=E(256,5-t))return null}else if(i>255)return null;for(o=z(r),n=0;n<r.length;n++)o+=r[n]*E(256,3-n);return o}(e),null===t)return G;this.host=t}else{if(C(re,e))return G;for(t="",r=v(e),n=0;n<r.length;n++)t+=fe(r[n],ie);this.host=t}},cannotHaveUsernamePasswordPort:function(){return!this.host||this.cannotBeABaseURL||"file"==this.scheme},includesCredentials:function(){return""!=this.username||""!=this.password},isSpecial:function(){return p(ce,this.scheme)},shortenPath:function(){var e=this.path,t=e.length;!t||"file"==this.scheme&&1==t&&le(e[0],!0)||e.length--},serialize:function(){var e=this,t=e.scheme,r=e.username,n=e.password,a=e.host,s=e.port,i=e.path,o=e.query,u=e.fragment,h=t+":";return null!==a?(h+="//",e.includesCredentials()&&(h+=r+(n?":"+n:"")+"@"),h+=se(a),null!==s&&(h+=":"+s)):"file"==t&&(h+="//"),h+=e.cannotBeABaseURL?i[0]:i.length?"/"+I(i,"/"):"",null!==o&&(h+="?"+o),null!==u&&(h+="#"+u),h},setHref:function(e){var t=this.parse(e);if(t)throw H(t);this.searchParams.update()},getOrigin:function(){var e=this.scheme,t=this.port;if("blob"==e)try{return new ze(e.path[0]).origin}catch(e){return"null"}return"file"!=e&&this.isSpecial()?e+"://"+se(this.host)+(null!==t?":"+t:""):"null"},getProtocol:function(){return this.scheme+":"},setProtocol:function(e){this.parse(w(e)+":",ve)},getUsername:function(){return this.username},setUsername:function(e){var t=v(w(e));if(!this.cannotHaveUsernamePasswordPort()){this.username="";for(var r=0;r<t.length;r++)this.username+=fe(t[r],he)}},getPassword:function(){return this.password},setPassword:function(e){var t=v(w(e));if(!this.cannotHaveUsernamePasswordPort()){this.password="";for(var r=0;r<t.length;r++)this.password+=fe(t[r],he)}},getHost:function(){var e=this.host,t=this.port;return null===e?"":null===t?se(e):se(e)+":"+t},setHost:function(e){this.cannotBeABaseURL||this.parse(e,Se)},getHostname:function(){var e=this.host;return null===e?"":se(e)},setHostname:function(e){this.cannotBeABaseURL||this.parse(e,Le)},getPort:function(){var e=this.port;return null===e?"":w(e)},setPort:function(e){this.cannotHaveUsernamePasswordPort()||(""==(e=w(e))?this.port=null:this.parse(e,xe))},getPathname:function(){var e=this.path;return this.cannotBeABaseURL?e[0]:e.length?"/"+I(e,"/"):""},setPathname:function(e){this.cannotBeABaseURL||(this.path=[],this.parse(e,Ae))},getSearch:function(){var e=this.query;return e?"?"+e:""},setSearch:function(e){""==(e=w(e))?this.query=null:("?"==j(e,0)&&(e=N(e,1)),this.query="",this.parse(e,Ce)),this.searchParams.update()},getSearchParams:function(){return this.searchParams.facade},getHash:function(){var e=this.fragment;return e?"#"+e:""},setHash:function(e){""!=(e=w(e))?("#"==j(e,0)&&(e=N(e,1)),this.fragment="",this.parse(e,Ie)):this.fragment=null},update:function(){this.query=this.searchParams.serialize()||null}};var ze=function(e){var t=l(this,Fe),r=U(arguments.length,1)>1?arguments[1]:void 0,n=R(t,new Oe(e,!1,r));s||(t.href=n.serialize(),t.origin=n.getOrigin(),t.protocol=n.getProtocol(),t.username=n.getUsername(),t.password=n.getPassword(),t.host=n.getHost(),t.hostname=n.getHostname(),t.port=n.getPort(),t.pathname=n.getPathname(),t.search=n.getSearch(),t.searchParams=n.getSearchParams(),t.hash=n.getHash())},Fe=ze.prototype,Te=function(e,t){return{get:function(){return S(this)[e]()},set:t&&function(e){return S(this)[t](e)},configurable:!0,enumerable:!0}};if(s&&f(Fe,{href:Te("serialize","setHref"),origin:Te("getOrigin"),protocol:Te("getProtocol","setProtocol"),username:Te("getUsername","setUsername"),password:Te("getPassword","setPassword"),host:Te("getHost","setHost"),hostname:Te("getHostname","setHostname"),port:Te("getPort","setPort"),pathname:Te("getPathname","setPathname"),search:Te("getSearch","setSearch"),searchParams:Te("getSearchParams"),hash:Te("getHash","setHash")}),c(Fe,"toJSON",(function(){return S(this).serialize()}),{enumerable:!0}),c(Fe,"toString",(function(){return S(this).serialize()}),{enumerable:!0}),q){var Me=q.createObjectURL,$e=q.revokeObjectURL;Me&&c(ze,"createObjectURL",u(Me,q)),$e&&c(ze,"revokeObjectURL",u($e,q))}b(ze,"URL"),a({global:!0,forced:!i,sham:!s},{URL:ze})}}]);