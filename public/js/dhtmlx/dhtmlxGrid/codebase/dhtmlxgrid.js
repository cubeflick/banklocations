//v.2.5 build 090904

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
To use this component please contact sales@dhtmlx.com to obtain license
*/




var globalActiveDHTMLGridObject;String.prototype._dhx_trim=function(){return this.replace(/&nbsp;/g, " ").replace(/(^[ \t]*)|([ \t]*$)/g, "")};function dhtmlxArray(ar){return dhtmlXHeir((ar||new Array()), dhtmlxArray._master)};dhtmlxArray._master={_dhx_find:function(pattern){for (var i = 0;i < this.length;i++){if (pattern == this[i])return i};return -1},
 _dhx_insertAt:function(ind, value){this[this.length]=null;for (var i = this.length-1;i >= ind;i--)this[i]=this[i-1]
 this[ind]=value
 },
 _dhx_removeAt:function(ind){this.splice(ind,1)
 },
 _dhx_swapItems:function(ind1, ind2){var tmp = this[ind1];this[ind1]=this[ind2]
 this[ind2]=tmp}};function dhtmlXGridObject(id){if (_isIE)try{document.execCommand("BackgroundImageCache", false, true)}catch (e){};if (id){if (typeof (id)== 'object'){this.entBox=id
 this.entBox.id="cgrid2_"+this.uid()}else
 this.entBox=document.getElementById(id)}else {this.entBox=document.createElement("DIV");this.entBox.id="cgrid2_"+this.uid()};this.entBox.innerHTML="";dhtmlxEventable(this);var self = this;this._wcorr=0;this.cell=null;this.row=null;this.iconURL="";this.editor=null;this._f2kE=true;this._dclE=true;this.combos=new Array(0);this.defVal=new Array(0);this.rowsAr={};this.rowsBuffer=dhtmlxArray();this.rowsCol=dhtmlxArray();this._data_cache={};this._ecache={};this._ud_enabled=true;this.xmlLoader=new dtmlXMLLoaderObject(this.doLoadDetails, this, true, this.no_cashe);this._maskArr=[];this.selectedRows=dhtmlxArray();this.UserData={};this._sizeFix=this._borderFix=0;this.entBox.className+=" gridbox";this.entBox.style.width=this.entBox.getAttribute("width")
 ||(window.getComputedStyle
 ? (this.entBox.style.width||window.getComputedStyle(this.entBox, null)["width"])
 : (this.entBox.currentStyle
 ? this.entBox.currentStyle["width"]
 : this.entBox.style.width||0))
 ||"100%";this.entBox.style.height=this.entBox.getAttribute("height")
 ||(window.getComputedStyle
 ? (this.entBox.style.height||window.getComputedStyle(this.entBox, null)["height"])
 : (this.entBox.currentStyle
 ? this.entBox.currentStyle["height"]
 : this.entBox.style.height||0))
 ||"100%";this.entBox.style.cursor='default';this.entBox.onselectstart=function(){return false
 };var t_creator=function(name){var t=document.createElement("TABLE");t.cellSpacing=t.cellPadding=0;t.style.cssText='width:100%;table-layout:fixed;';t.className=name.substr(2);return t};this.obj=t_creator("c_obj");this.hdr=t_creator("c_hdr");this.hdr.style.marginRight="0px";this.hdr.style.paddingRight="0px";this.objBox=document.createElement("DIV");this.objBox.style.width="100%";this.objBox.style.overflow="auto";this.objBox.appendChild(this.obj);this.objBox.className="objbox";this.hdrBox=document.createElement("DIV");this.hdrBox.style.width="100%"
 this.hdrBox.style.height="25px";this.hdrBox.style.overflow="hidden";this.hdrBox.className="xhdr";this.preloadImagesAr=new Array(0)

 this.sortImg=document.createElement("IMG")
 this.sortImg.style.display="none";this.hdrBox.appendChild(this.sortImg)
 this.hdrBox.appendChild(this.hdr);this.hdrBox.style.position="relative";this.entBox.appendChild(this.hdrBox);this.entBox.appendChild(this.objBox);this.entBox.grid=this;this.objBox.grid=this;this.hdrBox.grid=this;this.obj.grid=this;this.hdr.grid=this;this.cellWidthPX=[];this.cellWidthPC=[];this.cellWidthType=this.entBox.cellwidthtype||"px";this.delim=this.entBox.delimiter||",";this._csvDelim=",";this.hdrLabels=[];this.columnIds=[];this.columnColor=[];this._hrrar=[];this.cellType=dhtmlxArray();this.cellAlign=[];this.initCellWidth=[];this.fldSort=[];this._srdh=(_isIE && (document.compatMode != "BackCompat") ? 24 : 20);this.imgURL=window.dhx_globalImgPath||"";this.isActive=false;this.isEditable=true;this.useImagesInHeader=false;this.pagingOn=false;this.rowsBufferOutSize=0;dhtmlxEvent(window, "unload", function(){try{if (self.destructor)self.destructor()}catch (e){}});this.setSkin=function(name){this.skin_name=name;this.entBox.className="gridbox gridbox_"+name;this.skin_h_correction=0;this.enableAlterCss("ev_"+name, "odd_"+name, this.isTreeGrid())
 this._fixAlterCss()
 

 switch (name){case "clear":
 this._topMb=document.createElement("DIV");this._topMb.className="topMumba";this._topMb.innerHTML="<img style='left:0px' src='"+this.imgURL
 +"skinC_top_left.gif'><img style='right:20px' src='"+this.imgURL+"skinC_top_right.gif'>";this.entBox.appendChild(this._topMb);this._botMb=document.createElement("DIV");this._botMb.className="bottomMumba";this._botMb.innerHTML="<img style='left:0px' src='"+this.imgURL
 +"skinD_bottom_left.gif'><img style='right:20px' src='"+this.imgURL+"skinD_bottom_right.gif'>";this.entBox.appendChild(this._botMb);this.entBox.style.position="relative";this.skin_h_correction=20;break;case "dhx_skyblue":
 case "glassy_blue":
 case "dhx_black":
 case "dhx_blue":
 case "modern":
 case "light":
 this._srdh=20;this.forceDivInHeader=true;break;case "xp":
 this.forceDivInHeader=true;if ((_isIE)&&(document.compatMode != "BackCompat"))
 this._srdh=25;else this._srdh=22;break;case "mt":
 if ((_isIE)&&(document.compatMode != "BackCompat"))
 this._srdh=25;else this._srdh=22;break;case "gray":
 if ((_isIE)&&(document.compatMode != "BackCompat"))
 this._srdh=22;break;case "sbdark":
 break};if (_isIE&&this.hdr){var d = this.hdr.parentNode;d.removeChild(this.hdr);d.appendChild(this.hdr)};this.setSizes()};if (_isIE)this.preventIECaching(true);if (window.dhtmlDragAndDropObject)this.dragger=new dhtmlDragAndDropObject();this._doOnScroll=function(e, mode){this.callEvent("onScroll", [
 this.objBox.scrollLeft,
 this.objBox.scrollTop
 ]);this.doOnScroll(e, mode)};this.doOnScroll=function(e, mode){this.hdrBox.scrollLeft=this.objBox.scrollLeft;if (this.ftr)this.ftr.parentNode.scrollLeft=this.objBox.scrollLeft;if (mode)return;if (this._srnd){if (this._dLoadTimer)window.clearTimeout(this._dLoadTimer);this._dLoadTimer=window.setTimeout(function(){self._update_srnd_view()}, 100)}};this.attachToObject=function(obj){obj.appendChild(this.globalBox?this.globalBox:this.entBox);this.setSizes()};this.init=function(fl){if ((this.isTreeGrid())&&(!this._h2)){this._h2=new dhtmlxHierarchy();if ((this._fake)&&(!this._realfake))
 this._fake._h2=this._h2;this._tgc={imgURL: null
 }};if (!this._hstyles)return;this.editStop()
 
 this.lastClicked=null;this.resized=null;this.fldSorted=this.r_fldSorted=null;this.cellWidthPX=[];this.cellWidthPC=[];if (this.hdr.rows.length > 0){this.clearAll(true)};var hdrRow = this.hdr.insertRow(0);for (var i = 0;i < this.hdrLabels.length;i++){hdrRow.appendChild(document.createElement("TH"));hdrRow.childNodes[i]._cellIndex=i;hdrRow.childNodes[i].style.height="0px"};if (_isIE && _isIE<8)hdrRow.style.position="absolute";else
 hdrRow.style.height='auto';var hdrRow = this.hdr.insertRow(_isKHTML ? 2 : 1);hdrRow._childIndexes=new Array();var col_ex = 0;for (var i = 0;i < this.hdrLabels.length;i++){hdrRow._childIndexes[i]=i-col_ex;if ((this.hdrLabels[i] == this.splitSign)&&(i != 0)){if (_isKHTML)hdrRow.insertCell(i-col_ex);hdrRow.cells[i-col_ex-1].colSpan=(hdrRow.cells[i-col_ex-1].colSpan||1)+1;hdrRow.childNodes[i-col_ex-1]._cellIndex++;col_ex++;hdrRow._childIndexes[i]=i-col_ex;continue};hdrRow.insertCell(i-col_ex);hdrRow.childNodes[i-col_ex]._cellIndex=i;hdrRow.childNodes[i-col_ex]._cellIndexS=i;this.setColumnLabel(i, this.hdrLabels[i])};if (col_ex == 0)hdrRow._childIndexes=null;this._cCount=this.hdrLabels.length;if (_isIE)window.setTimeout(function(){self.setSizes()}, 1);if (!this.obj.firstChild)this.obj.appendChild(document.createElement("TBODY"));var tar = this.obj.firstChild;if (!tar.firstChild){tar.appendChild(document.createElement("TR"));tar=tar.firstChild;if (_isIE && _isIE<8)tar.style.position="absolute";else
 tar.style.height='auto';for (var i = 0;i < this.hdrLabels.length;i++){tar.appendChild(document.createElement("TH"));tar.childNodes[i].style.height="0px"}};this._c_order=null;if (this.multiLine != true)this.obj.className+=" row20px";this.sortImg.style.position="absolute";this.sortImg.style.display="none";this.sortImg.src=this.imgURL+"sort_desc.gif";this.sortImg.defLeft=0;if (this.noHeader){this.hdrBox.style.display='none'}else {this.noHeader=false
 };if (this._ivizcol)this.setColHidden();this.attachHeader();this.attachHeader(0, 0, "_aFoot");this.setSizes();if (fl)this.parseXML()
 this.obj.scrollTop=0

 if (this.dragAndDropOff)this.dragger.addDragLanding(this.entBox, this);if (this._initDrF)this._initD();if (this._init_point)this._init_point()};this.setColumnSizes=function(gridWidth){var summ = 0;var fcols = [];for (var i = 0;i < this._cCount;i++){if ((this.initCellWidth[i] == "*")&& !this._hrrar[i]){this._awdth=false;fcols.push(i);continue};if (this.cellWidthType == '%'){if (typeof this.cellWidthPC[i]=="undefined")this.cellWidthPC[i]=this.initCellWidth[i];this.cellWidthPX[i]=Math.floor(gridWidth*this.cellWidthPC[i]/100)||0}else{if (typeof this.cellWidthPX[i]=="undefined")this.cellWidthPX[i]=this.initCellWidth[i]};if (!this._hrrar[i])summ+=this.cellWidthPX[i]*1};if (fcols.length){var ms = Math.floor((gridWidth-summ)/fcols.length);if (ms < 0)ms=1;for (var i = 0;i < fcols.length;i++){var next=Math.max((this._drsclmW ? this._drsclmW[fcols[i]] : 0),ms)
 this.cellWidthPX[fcols[i]]=next;summ+=next};this._setAutoResize()};this.obj.style.width=summ+"px";this.hdr.style.width=summ+"px";if (this.ftr)this.ftr.style.width=summ+"px";this.chngCellWidth();return summ};this.setSizes=function(){if ((!this.hdr.rows[0])) return;window.clearTimeout(this._sizeTime);if (!this.entBox.offsetWidth && (!this.globalBox || !this.globalBox.offsetWidth)){this._sizeTime=window.setTimeout(function(){self.setSizes()
 }, 250);return};var quirks=this.quirks = (_isIE && document.compatMode=="BackCompat");var outerBorder=(this.entBox.offsetWidth-this.entBox.clientWidth)/2;if (this.globalBox){var splitOuterBorder=(this.globalBox.offsetWidth-this.globalBox.clientWidth)/2;if (this._delta_x && !this._realfake){this.globalBox.style.width=this._delta_x;this.entBox.style.width=Math.max(0,(this.globalBox.clientWidth+(quirks?splitOuterBorder*2:0))-this._fake.entBox.clientWidth)+"px"};if (this._delta_y && !this._realfake){this.globalBox.style.height=this._delta_y;this.entBox.style.overflow=this._fake.entBox.style.overflow="hidden";this.entBox.style.height=this._fake.entBox.style.height=this.globalBox.clientHeight+(quirks?splitOuterBorder*2:0)+"px"}}else {if (this._delta_x){if (this.entBox.parentNode.tagName=="TD"){this.entBox.style.width="1px";this.entBox.style.width=parseInt(this._delta_x)*this.entBox.parentNode.clientWidth/100-outerBorder*2+"px"}else
 this.entBox.style.width=this._delta_x};if (this._delta_y)this.entBox.style.height=this._delta_y};var isVScroll = this.parentGrid?false:(this.objBox.scrollHeight > this.objBox.offsetHeight);var isHScroll = this.parentGrid?false:((this.objBox.scrollWidth > this.objBox.offsetWidth)||(this.objBox.style.overflowX=="scroll"));var scrfix = _isFF?18:18;var gridWidth=this.entBox.clientWidth-(this.skin_h_correction||0)*(quirks?0:1);var gridWidthActive=this.entBox.clientWidth-(this.skin_h_correction||0);var gridHeight=this.entBox.clientHeight;var summ=this.setColumnSizes(gridWidthActive-(isVScroll?scrfix:0));var headerHeight = this.hdr.clientHeight;var footerHeight = this.ftr?this.ftr.clientHeight:0;var newWidth=gridWidth;var newHeight=gridHeight-headerHeight-footerHeight;if (this._awdth && this._awdth[0] && this._awdth[1]==99999)isHScroll=0;if (this._ahgr){if (this._ahgrMA)newHeight=this.entBox.parentNode.clientHeight-headerHeight-footerHeight;else
 newHeight=this.obj.offsetHeight+(isHScroll?scrfix:0);if (this._ahgrM){if (this._ahgrF)newHeight=Math.min(this._ahgrM,newHeight+headerHeight+footerHeight)-headerHeight-footerHeight;else 
 newHeight=Math.min(this._ahgrM,newHeight)};if (isVScroll && newHeight>=this.obj.scrollHeight+(isHScroll?scrfix:0)){isVScroll=false;this.setColumnSizes(gridWidthActive)}};if ((this._awdth)&&(this._awdth[0])){if (this.cellWidthType == '%')this.cellWidthType="px";if (this._fake)summ+=this._fake.entBox.clientWidth;var newWidth=Math.min(Math.max(summ+(isVScroll?scrfix:0),this._awdth[2]),this._awdth[1]);if (this._fake)newWidth-=this._fake.entBox.clientWidth};newHeight=Math.max(0,newHeight);this._ff_size_delta=(this._ff_size_delta==0.1)?0.2:0.1;if (!_isFF)this._ff_size_delta=0;this.entBox.style.width=newWidth+(quirks?2:0)*outerBorder+this._ff_size_delta+"px";this.entBox.style.height=newHeight+(quirks?2:0)*outerBorder+headerHeight+footerHeight+"px";this.objBox.style.height=newHeight+((quirks&&!isVScroll)?2:0)*outerBorder+"px";this.hdrBox.style.height=headerHeight+"px";if (newHeight != gridHeight)this.doOnScroll(0, !this._srnd);var ext=this["setSizes_"+this.skin_name];if (ext)ext.call(this);this.setSortImgPos();if (headerHeight != this.hdr.clientHeight && this._ahgr)this.setSizes()};this.setSizes_clear=function(){var y=this.hdr.offsetHeight;var x=this.entBox.offsetWidth;var y2=y+this.objBox.offsetHeight;this._topMb.style.top=(y||0)+"px";this._topMb.style.width=(x+20)+"px";this._botMb.style.top=(y2-3)+"px";this._botMb.style.width=(x+20)+"px"};this.chngCellWidth=function(){if ((_isOpera)&&(this.ftr))
 this.ftr.width=this.objBox.scrollWidth+"px";var l = this._cCount;for (var i = 0;i < l;i++){this.hdr.rows[0].cells[i].style.width=this.cellWidthPX[i]+"px";this.obj.rows[0].childNodes[i].style.width=this.cellWidthPX[i]+"px";if (this.ftr)this.ftr.rows[0].cells[i].style.width=this.cellWidthPX[i]+"px"}};this.setDelimiter=function(delim){this.delim=delim};this.setInitWidthsP=function(wp){this.cellWidthType="%";this.initCellWidth=wp.split(this.delim.replace(/px/gi, ""));if (!arguments[1])this._setAutoResize()};this._setAutoResize=function(){if (this._realfake)return;var el = window;var self = this;dhtmlxEvent(window,"resize",function(){window.clearTimeout(self._resize_timer);if (self._setAutoResize)self._resize_timer=window.setTimeout(function(){self.setSizes();if (self._fake)self._fake._correctSplit()}, 100)})
 };this.setInitWidths=function(wp){this.cellWidthType="px";this.initCellWidth=wp.split(this.delim);if (_isFF){for (var i = 0;i < this.initCellWidth.length;i++)if (this.initCellWidth[i] != "*")this.initCellWidth[i]=parseInt(this.initCellWidth[i])}};this.enableMultiline=function(state){this.multiLine=convertStringToBoolean(state)};this.enableMultiselect=function(state){this.selMultiRows=convertStringToBoolean(state)};this.setImagePath=function(path){this.imgURL=path};this.setImagesPath=this.setImagePath;this.setIconPath=function(path){this.iconURL=path};this.setIconsPath=this.setIconPath;this.changeCursorState=function(ev){var el = ev.target||ev.srcElement;if (el.tagName != "TD")el=this.getFirstParentOfType(el, "TD")
 if (!el)return;if ((el.tagName == "TD")&&(this._drsclmn)&&(!this._drsclmn[el._cellIndex]))
 return el.style.cursor="default";var check = (ev.layerX||0)+(((!_isIE)&&(ev.target.tagName == "DIV")) ? el.offsetLeft : 0);if ((el.offsetWidth-(ev.offsetX||(parseInt(this.getPosition(el, this.hdrBox))-check)*-1)) < (_isOpera?20:10)){el.style.cursor="E-resize"}else{el.style.cursor="default"};if (_isOpera)this.hdrBox.scrollLeft=this.objBox.scrollLeft};this.startColResize=function(ev){this.resized=null;var el = ev.target||ev.srcElement;if (el.tagName != "TD")el=this.getFirstParentOfType(el, "TD")
 var x = ev.clientX;var tabW = this.hdr.offsetWidth;var startW = parseInt(el.offsetWidth)

 if (el.tagName == "TD"&&el.style.cursor != "default"){if ((this._drsclmn)&&(!this._drsclmn[el._cellIndex]))
 return;self._old_d_mm=document.body.onmousemove;self._old_d_mu=document.body.onmouseup;document.body.onmousemove=function(e){self.doColResize(e||window.event, el, startW, x, tabW)
 };document.body.onmouseup=function(){self.stopColResize()}}};this.stopColResize=function(){document.body.onmousemove=self._old_d_mm;document.body.onmouseup=self._old_d_mu;this.setSizes();this.doOnScroll(0, 1)
 this.callEvent("onResizeEnd", [this])};this.doColResize=function(ev, el, startW, x, tabW){el.style.cursor="E-resize";this.resized=el;var fcolW = startW+(ev.clientX-x);var wtabW = tabW+(ev.clientX-x)

 if (!(this.callEvent("onResize", [
 el._cellIndex,
 fcolW,
 this
 ])))
 return;if (_isIE)this.objBox.scrollLeft=this.hdrBox.scrollLeft;if (el.colSpan > 1){var a_sizes = new Array();for (var i = 0;i < el.colSpan;i++)a_sizes[i]=Math.round(fcolW*this.hdr.rows[0].childNodes[el._cellIndexS+i].offsetWidth/el.offsetWidth);for (var i = 0;i < el.colSpan;i++)this._setColumnSizeR(el._cellIndexS+i*1, a_sizes[i])}else
 this._setColumnSizeR(el._cellIndex, fcolW);this.doOnScroll(0, 1);this.setSizes()};this._setColumnSizeR=function(ind, fcolW){if (fcolW > ((this._drsclmW&&!this._notresize)? (this._drsclmW[ind]||10) : 10)){this.obj.rows[0].childNodes[ind].style.width=fcolW+"px";this.hdr.rows[0].childNodes[ind].style.width=fcolW+"px";if (this.ftr)this.ftr.rows[0].childNodes[ind].style.width=fcolW+"px";if (this.cellWidthType == 'px'){this.cellWidthPX[ind]=fcolW}else {var gridWidth = parseInt(this.entBox.offsetWidth);if (this.objBox.scrollHeight > this.objBox.offsetHeight)gridWidth-=17;var pcWidth = Math.round(fcolW / gridWidth*100)
 this.cellWidthPC[ind]=pcWidth};if (this.sortImg.style.display!="none")this.setSortImgPos()}};this.setSortImgState=function(state, ind, order, row){order=(order||"asc").toLowerCase();if (!convertStringToBoolean(state)){this.sortImg.style.display="none";this.fldSorted=null;return};if (order == "asc")this.sortImg.src=this.imgURL+"sort_asc.gif";else
 this.sortImg.src=this.imgURL+"sort_desc.gif";this.sortImg.style.display="";this.fldSorted=this.hdr.rows[0].childNodes[ind];var r = this.hdr.rows[row||1];if (!r)return;for (var i = 0;i < r.childNodes.length;i++){if (r.childNodes[i]._cellIndexS == ind){this.r_fldSorted=r.childNodes[i];return this.setSortImgPos()}};return this.setSortImgState(state,ind,order,(row||1)+1)};this.setSortImgPos=function(ind, mode, hRowInd, el){if (this._hrrar && this._hrrar[this.r_fldSorted?this.r_fldSorted._cellIndex:ind])return;if (!el){if (!ind)var el = this.r_fldSorted;else
 var el = this.hdr.rows[hRowInd||0].cells[ind]};if (el != null){var pos = this.getPosition(el, this.hdrBox)
 var wdth = el.offsetWidth;this.sortImg.style.left=Number(pos[0]+wdth-13)+"px";this.sortImg.defLeft=parseInt(this.sortImg.style.left)
 this.sortImg.style.top=Number(pos[1]+5)+"px";if ((!this.useImagesInHeader)&&(!mode))
 this.sortImg.style.display="inline";this.sortImg.style.left=this.sortImg.defLeft+"px"}};this.setActive=function(fl){if (arguments.length == 0)var fl = true;if (fl == true){if (globalActiveDHTMLGridObject&&(globalActiveDHTMLGridObject != this))
 globalActiveDHTMLGridObject.editStop();globalActiveDHTMLGridObject=this;this.isActive=true}else {this.isActive=false}};this._doClick=function(ev){var selMethod = 0;var el = this.getFirstParentOfType(_isIE ? ev.srcElement : ev.target, "TD");if (!el)return;var fl = true;if (this.markedCells){var markMethod = 0;if (ev.shiftKey||ev.metaKey){markMethod=1};if (ev.ctrlKey){markMethod=2};this.doMark(el, markMethod);return true};if (this.selMultiRows != false){if (ev.shiftKey&&this.row != null){selMethod=1};if (ev.ctrlKey||ev.metaKey){selMethod=2}};this.doClick(el, fl, selMethod)
 };this._doContClick=function(ev){var el = this.getFirstParentOfType(_isIE ? ev.srcElement : ev.target, "TD");if ((!el)||( typeof (el.parentNode.idd) == "undefined"))
 return true;if (ev.button == 2||(_isMacOS&&ev.ctrlKey)){if (!this.callEvent("onRightClick", [
 el.parentNode.idd,
 el._cellIndex,
 ev
 ])){var z = function(e){(e||event).cancelBubble=true;return false};ev.srcElement.oncontextmenu=z;return z(ev)};if (this._ctmndx){if (!(this.callEvent("onBeforeContextMenu", [
 el.parentNode.idd,
 el._cellIndex,
 this
 ])))
 return true;if (_isIE)ev.srcElement.oncontextmenu=function(){event.cancelBubble=true;return false};if (this._ctmndx.showContextMenu){var dEl0=window.document.documentElement;var dEl1=window.document.body;var corrector = new Array((dEl0.scrollLeft||dEl1.scrollLeft),(dEl0.scrollTop||dEl1.scrollTop));if (_isIE){var x= ev.clientX+corrector[0];var y = ev.clientY+corrector[1]}else {var x= ev.pageX;var y = ev.pageY};this._ctmndx.showContextMenu(x-1,y-1)
 this.contextID=this._ctmndx.contextMenuZoneId=el.parentNode.idd+"_"+el._cellIndex;this._ctmndx._skip_hide=true}else {el.contextMenuId=el.parentNode.idd+"_"+el._cellIndex;el.contextMenu=this._ctmndx;el.a=this._ctmndx._contextStart;el.a(el, ev);el.a=null};ev.cancelBubble=true}}else if (this._ctmndx){if (this._ctmndx.hideContextMenu)this._ctmndx.hideContextMenu()
 else
 this._ctmndx._contextEnd()};return true};this.doClick=function(el, fl, selMethod, show){if (!this.selMultiRows)selMethod=0;var psid = this.row ? this.row.idd : 0;this.setActive(true);if (!selMethod)selMethod=0;if (this.cell != null)this.cell.className=this.cell.className.replace(/cellselected/g, "");if (el.tagName == "TD"){if (this.checkEvent("onSelectStateChanged"))
 var initial = this.getSelectedId();var prow = this.row;if (selMethod == 1){var elRowIndex = this.rowsCol._dhx_find(el.parentNode)
 var lcRowIndex = this.rowsCol._dhx_find(this.lastClicked)

 if (elRowIndex > lcRowIndex){var strt = lcRowIndex;var end = elRowIndex}else {var strt = elRowIndex;var end = lcRowIndex};for (var i = 0;i < this.rowsCol.length;i++)if ((i >= strt&&i <= end)){if (this.rowsCol[i]&&(!this.rowsCol[i]._sRow)){if (this.rowsCol[i].className.indexOf("rowselected")== -1&&this.callEvent("onBeforeSelect", [
 this.rowsCol[i].idd,
 psid
 ])){this.rowsCol[i].className+=" rowselected";this.selectedRows[this.selectedRows.length]=this.rowsCol[i]
 }}else {this.clearSelection();return this.doClick(el, fl, 0, show)}}}else if (selMethod == 2){if (el.parentNode.className.indexOf("rowselected")!= -1){el.parentNode.className=el.parentNode.className.replace(/rowselected/g, "");this.selectedRows._dhx_removeAt(this.selectedRows._dhx_find(el.parentNode))
 var skipRowSelection = true}};this.editStop()
 if (typeof (el.parentNode.idd)== "undefined")
 return true;if ((!skipRowSelection)&&(!el.parentNode._sRow)){if (this.callEvent("onBeforeSelect", [
 el.parentNode.idd,
 psid
 ])){if (selMethod == 0)this.clearSelection();this.cell=el;if ((prow == el.parentNode)&&(this._chRRS))
 fl=false;this.row=el.parentNode;this.row.className+=" rowselected"
 
 if (this.cell && _isIE && _isIE == 8 ){var next = this.cell.nextSibling;var parent = this.cell.parentNode;parent.removeChild(this.cell)
 parent.insertBefore(this.cell,next)};if (this.selectedRows._dhx_find(this.row)== -1)
 this.selectedRows[this.selectedRows.length]=this.row}};if (this.cell && this.cell.parentNode.className.indexOf("rowselected")!= -1)
 this.cell.className=this.cell.className.replace(/cellselected/g, "")+" cellselected";if (selMethod != 1)if (!this.row)return;this.lastClicked=el.parentNode;var rid = this.row.idd;var cid = this.cell;if (fl&& typeof (rid)!= "undefined" && cid && !skipRowSelection)
 self.onRowSelectTime=setTimeout(function(){self.callEvent("onRowSelect", [
 rid,
 cid._cellIndex
 ])}, 100)

 if (this.checkEvent("onSelectStateChanged")){var afinal = this.getSelectedId();if (initial != afinal)this.callEvent("onSelectStateChanged", [afinal,initial])}};this.isActive=true;if (show !== false && this.cell && this.cell.parentNode.idd)this.moveToVisible(this.cell)
 };this.selectAll=function(){this.clearSelection();this.selectedRows=dhtmlxArray([].concat(this.rowsCol));for (var i = this.rowsCol.length-1;i >= 0;i--){if (this.rowsCol[i]._cntr)this.selectedRows.splice(i, 1);else
 this.rowsCol[i].className+=" rowselected"};if (this.selectedRows.length){this.row=this.selectedRows[0];this.cell=this.row.cells[0]};if ((this._fake)&&(!this._realfake))
 this._fake.selectAll()};this.selectCell=function(r, cInd, fl, preserve, edit, show){if (!fl)fl=false;if (typeof (r)!= "object")
 r=this.render_row(r)
 if (!r || r==-1)return null;if (r._childIndexes)var c = r.childNodes[r._childIndexes[cInd]];else


 var c = r.childNodes[cInd];if (!c)c=r.childNodes[0];if (preserve)this.doClick(c, fl, 3, show)
 else
 this.doClick(c, fl, 0, show)

 if (edit)this.editCell()};this.moveToVisible=function(cell_obj, onlyVScroll){if (this.pagingOn){var newPage=Math.floor(this.getRowIndex(cell_obj.parentNode.idd) / this.rowsBufferOutSize)+1;if (newPage!=this.currentPage)this.changePage(newPage)};if (!cell_obj.offsetHeight){var mask=this._realfake?this._fake.rowsAr[cell_obj.parentNode.idd]:cell_obj.parentNode;var h=this.rowsBuffer._dhx_find(mask)*this._srdh;return this.objBox.scrollTop=h};try{var distance = cell_obj.offsetLeft+cell_obj.offsetWidth+20;var scrollLeft = 0;if (distance > (this.objBox.offsetWidth+this.objBox.scrollLeft)){if (cell_obj.offsetLeft > this.objBox.scrollLeft)scrollLeft=cell_obj.offsetLeft-5
 }else if (cell_obj.offsetLeft < this.objBox.scrollLeft){distance-=cell_obj.offsetWidth*2/3;if (distance < this.objBox.scrollLeft)scrollLeft=cell_obj.offsetLeft-5
 };if ((scrollLeft)&&(!onlyVScroll))
 this.objBox.scrollLeft=scrollLeft;var distance = cell_obj.offsetTop+cell_obj.offsetHeight+20;if (distance > (this.objBox.offsetHeight+this.objBox.scrollTop)){var scrollTop = distance-this.objBox.offsetHeight}else if (cell_obj.offsetTop < this.objBox.scrollTop){var scrollTop = cell_obj.offsetTop-5
 };if (scrollTop)this.objBox.scrollTop=scrollTop}catch (er){}};this.editCell=function(){if (this.editor&&this.cell == this.editor.cell)return;this.editStop();if ((this.isEditable != true)||(!this.cell))
 return false;var c = this.cell;if (c.parentNode._locked)return false;this.editor=this.cells4(c);if (this.editor != null){if (this.editor.isDisabled()){this.editor=null;return false};if (this.callEvent("onEditCell", [
 0,
 this.row.idd,
 this.cell._cellIndex
 ])!= false&&this.editor.edit){this._Opera_stop=(new Date).valueOf();c.className+=" editable";this.editor.edit();this.callEvent("onEditCell", [
 1,
 this.row.idd,
 this.cell._cellIndex
 ])
 }else {this.editor=null}}};this.editStop=function(mode){if (_isOpera)if (this._Opera_stop){if ((this._Opera_stop*1+50)> (new Date).valueOf())
 return;this._Opera_stop=null};if (this.editor&&this.editor != null){this.editor.cell.className=this.editor.cell.className.replace("editable", "");if (mode){var t = this.editor.val;this.editor.detach();this.editor.setValue(t);this.editor=null;return};if (this.editor.detach())
 this.cell.wasChanged=true;var g = this.editor;this.editor=null;var z = this.callEvent("onEditCell", [
 2,
 this.row.idd,
 this.cell._cellIndex,
 g.getValue(),
 g.val
 ]);if (( typeof (z)== "string")||( typeof (z) == "number"))
 g[g.setImage ? "setLabel" : "setValue"](z);else if (!z)g[g.setImage ? "setLabel" : "setValue"](g.val)}};this._nextRowCell=function(row, dir, pos){row=this._nextRow((this._groups?this.rowsCol:this.rowsBuffer)._dhx_find(row), dir);if (!row)return null;return row.childNodes[row._childIndexes ? row._childIndexes[pos] : pos]};this._getNextCell=function(acell, dir, i){acell=acell||this.cell;var arow = acell.parentNode;if (this._tabOrder){i=this._tabOrder[acell._cellIndex];if (typeof i != "undefined")if (i < 0)acell=this._nextRowCell(arow, dir, Math.abs(i)-1);else
 acell=arow.childNodes[i]}else {var i = acell._cellIndex+dir;if (i >= 0&&i < this._cCount){if (arow._childIndexes)i=arow._childIndexes[acell._cellIndex]+dir;acell=arow.childNodes[i]}else {acell=this._nextRowCell(arow, dir, (dir == 1 ? 0 : (this._cCount-1)))}};if (!acell){if ((dir == 1)&&this.tabEnd){this.tabEnd.focus();this.tabEnd.focus()};if ((dir == -1)&&this.tabStart){this.tabStart.focus();this.tabStart.focus()};return null};if (acell.style.display != "none"
 &&(!this.smartTabOrder||!this.cells(acell.parentNode.idd, acell._cellIndex).isDisabled()))
 return acell;return this._getNextCell(acell, dir)};this._nextRow=function(ind, dir){var r = this.render_row(ind+dir);if (!r || r==-1)return null;if (r&&r.style.display == "none")return this._nextRow(ind+dir, dir);return r};this.scrollPage=function(dir){var master = this._realfake?this._fake:this;var new_ind = Math.floor((master._r_select||this.getRowIndex(this.row.idd)||0)+(dir)*this.objBox.offsetHeight / (this._srdh||20));if (new_ind < 0)new_ind=0;if (new_ind >= this.rowsBuffer.length)new_ind=this.rowsBuffer.length-1;if (this._srnd && !this.rowsBuffer[new_ind]){this.objBox.scrollTop+=Math.floor((dir)*this.objBox.offsetHeight / (this._srdh||20))*(this._srdh||20);master._r_select=new_ind}else {this.selectCell(new_ind, this.cell._cellIndex, true, false,false,(this.multiLine || this._srnd));if (!this.multiLine && !this._srnd && !this._realfake)this.objBox.scrollTop=this.getRowById(this.getRowId(new_ind)).offsetTop;master._r_select=null}};this.doKey=function(ev){if (!ev)return true;if ((ev.target||ev.srcElement).value !== window.undefined){var zx = (ev.target||ev.srcElement);if ((!zx.parentNode)||(zx.parentNode.className.indexOf("editable") == -1))
 return true};if ((globalActiveDHTMLGridObject)&&(this != globalActiveDHTMLGridObject))
 return globalActiveDHTMLGridObject.doKey(ev);if (this.isActive == false){return true};if (this._htkebl)return true;if (!this.callEvent("onKeyPress", [
 ev.keyCode,
 ev.ctrlKey,
 ev.shiftKey,
 ev
 ]))
 return false;var code = "k"+ev.keyCode+"_"+(ev.ctrlKey ? 1 : 0)+"_"+(ev.shiftKey ? 1 : 0);if (this.cell){if (this._key_events[code]){if (false === this._key_events[code].call(this))
 return true;if (ev.preventDefault)ev.preventDefault();ev.cancelBubble=true;return false};if (this._key_events["k_other"])this._key_events.k_other.call(this, ev)};return true};this.selectRow=function(r, fl, preserve, show){if (typeof (r)!= 'object')
 r=this.render_row(r);this.selectCell(r, 0, fl, preserve, false, show)
 };this.wasDblClicked=function(ev){var el = this.getFirstParentOfType(_isIE ? ev.srcElement : ev.target, "TD");if (el){var rowId = el.parentNode.idd;return this.callEvent("onRowDblClicked", [
 rowId,
 el._cellIndex
 ])}};this._onHeaderClick=function(e, el){var that = this.grid;el=el||that.getFirstParentOfType(_isIE ? event.srcElement : e.target, "TD");if (this.grid.resized == null){if (!(this.grid.callEvent("onHeaderClick", [
 el._cellIndexS,
 (e||window.event)])))
 return false;that.sortField(el._cellIndexS, false, el)

 }};this.deleteSelectedRows=function(){var num = this.selectedRows.length 

 if (num == 0)return;var tmpAr = this.selectedRows;this.selectedRows=dhtmlxArray()
 for (var i = num-1;i >= 0;i--){var node = tmpAr[i]

 if (!this.deleteRow(node.idd, node)){this.selectedRows[this.selectedRows.length]=node}else {if (node == this.row){var ind = i}}};if (ind){try{if (ind+1 > this.rowsCol.length)ind--;this.selectCell(ind, 0, true)
 }catch (er){this.row=null
 this.cell=null
 }}};this.getSelectedRowId=function(){var selAr = new Array(0);var uni = {};for (var i = 0;i < this.selectedRows.length;i++){var id = this.selectedRows[i].idd;if (uni[id])continue;selAr[selAr.length]=id;uni[id]=true};if (selAr.length == 0)return null;else
 return selAr.join(this.delim)};this.getSelectedCellIndex=function(){if (this.cell != null)return this.cell._cellIndex;else
 return -1};this.getColWidth=function(ind){return parseInt(this.cellWidthPX[ind])+((_isFF) ? 2 : 0)};this.setColWidth=function(ind, value){if (this._hrrar[ind])return;if (this.cellWidthType == 'px')this.cellWidthPX[ind]=parseInt(value)-+((_isFF) ? 2 : 0);else
 this.cellWidthPC[ind]=parseInt(value);this.setSizes()};this.getRowIndex=function(row_id){for (var i = 0;i < this.rowsBuffer.length;i++)if (this.rowsBuffer[i]&&this.rowsBuffer[i].idd == row_id)return i;return -1};this.getRowId=function(ind){return this.rowsBuffer[ind] ? this.rowsBuffer[ind].idd : this.undefined};this.setRowId=function(ind, row_id){this.changeRowId(this.getRowId(ind), row_id)
 };this.changeRowId=function(oldRowId, newRowId){if (oldRowId == newRowId)return;var row = this.rowsAr[oldRowId]
 row.idd=newRowId;if (this.UserData[oldRowId]){this.UserData[newRowId]=this.UserData[oldRowId]
 this.UserData[oldRowId]=null};if (this._h2&&this._h2.get[oldRowId]){this._h2.get[newRowId]=this._h2.get[oldRowId];this._h2.get[newRowId].id=newRowId;delete this._h2.get[oldRowId]};this.rowsAr[oldRowId]=null;this.rowsAr[newRowId]=row;for (var i = 0;i < row.childNodes.length;i++)if (row.childNodes[i]._code)row.childNodes[i]._code=this._compileSCL(row.childNodes[i]._val, row.childNodes[i]);if (this._mat_links && this._mat_links[oldRowId]){var a=this._mat_links[oldRowId];delete this._mat_links[oldRowId];for (var c in a)for (var i=0;i < a[c].length;i++)this._compileSCL(a[c][i].original,a[c][i])};this.callEvent("onRowIdChange",[oldRowId,newRowId])};this.setColumnIds=function(ids){this.columnIds=ids.split(this.delim)
 };this.setColumnId=function(ind, id){this.columnIds[ind]=id};this.getColIndexById=function(id){for (var i = 0;i < this.columnIds.length;i++)if (this.columnIds[i] == id)return i};this.getColumnId=function(cin){return this.columnIds[cin]};this.getColumnLabel=function(cin, ind, hdr){var z = (hdr||this.hdr).rows[(ind||0)+1];for (var i=0;i<z.cells.length;i++)if (z.cells[i]._cellIndexS==cin)return (_isIE ? z.cells[i].innerText : z.cells[i].textContent);return ""};this.getFooterLabel=function(cin, ind){return this.getColumnLabel(cin,ind,this.ftr)};this.setRowTextBold=function(row_id){var r=this.getRowById(row_id)
 if (r)r.style.fontWeight="bold"};this.setRowTextStyle=function(row_id, styleString){var r = this.getRowById(row_id)
 if (!r)return;for (var i = 0;i < r.childNodes.length;i++){var pfix = r.childNodes[i]._attrs["style"]||"";if ((this._hrrar)&&(this._hrrar[i]))
 pfix="display:none;";if (_isIE)r.childNodes[i].style.cssText=pfix+"width:"+r.childNodes[i].style.width+";"+styleString;else
 r.childNodes[i].style.cssText=pfix+"width:"+r.childNodes[i].style.width+";"+styleString}};this.setRowColor=function(row_id, color){var r = this.getRowById(row_id)

 for (var i = 0;i < r.childNodes.length;i++)r.childNodes[i].bgColor=color};this.setCellTextStyle=function(row_id, ind, styleString){var r = this.getRowById(row_id)

 if (!r)return;var cell = r.childNodes[r._childIndexes ? r._childIndexes[ind] : ind];if (!cell)return;var pfix = "";if ((this._hrrar)&&(this._hrrar[ind]))
 pfix="display:none;";if (_isIE)cell.style.cssText=pfix+"width:"+cell.style.width+";"+styleString;else
 cell.style.cssText=pfix+"width:"+cell.style.width+";"+styleString};this.setRowTextNormal=function(row_id){var r=this.getRowById(row_id);if (r)r.style.fontWeight="normal"};this.doesRowExist=function(row_id){if (this.getRowById(row_id)!= null)
 return true
 else
 return false
 };this.getColumnsNum=function(){return this._cCount};this.moveRowUp=function(row_id){var r = this.getRowById(row_id)

 if (this.isTreeGrid())
 return this.moveRowUDTG(row_id, -1);var rInd = this.rowsCol._dhx_find(r)
 if ((r.previousSibling)&&(rInd != 0)){r.parentNode.insertBefore(r, r.previousSibling)
 this.rowsCol._dhx_swapItems(rInd, rInd-1)
 this.setSizes();var bInd=this.rowsBuffer._dhx_find(r);this.rowsBuffer._dhx_swapItems(bInd,bInd-1);if (this._cssEven)this._fixAlterCss(rInd-1)}};this.moveRowDown=function(row_id){var r = this.getRowById(row_id)

 if (this.isTreeGrid())
 return this.moveRowUDTG(row_id, 1);var rInd = this.rowsCol._dhx_find(r);if (r.nextSibling){this.rowsCol._dhx_swapItems(rInd, rInd+1)

 if (r.nextSibling.nextSibling)r.parentNode.insertBefore(r, r.nextSibling.nextSibling)
 else
 r.parentNode.appendChild(r)
 this.setSizes();var bInd=this.rowsBuffer._dhx_find(r);this.rowsBuffer._dhx_swapItems(bInd,bInd+1);if (this._cssEven)this._fixAlterCss(rInd)}};this.getCombo=function(col_ind){if (!this.combos[col_ind]){this.combos[col_ind]=new dhtmlXGridComboObject()};return this.combos[col_ind]};this.setUserData=function(row_id, name, value){if (!row_id)row_id="gridglobaluserdata";if (!this.UserData[row_id])this.UserData[row_id]=new Hashtable()
 this.UserData[row_id].put(name, value)
 };this.getUserData=function(row_id, name){if (!row_id)row_id="gridglobaluserdata";this.getRowById(row_id);var z = this.UserData[row_id];return (z ? z.get(name) : "")};this.setEditable=function(fl){this.isEditable=convertStringToBoolean(fl)};this.selectRowById=function(row_id, multiFL, show, call){if (!call)call=false;this.selectCell(this.getRowById(row_id), 0, call, multiFL, false, show)};this.clearSelection=function(){this.editStop()

 for (var i = 0;i < this.selectedRows.length;i++){var r = this.rowsAr[this.selectedRows[i].idd];if (r)r.className=r.className.replace(/rowselected/g, "")};this.selectedRows=dhtmlxArray()
 this.row=null;if (this.cell != null){this.cell.className=this.cell.className.replace(/cellselected/g, "");this.cell=null}};this.copyRowContent=function(from_row_id, to_row_id){var frRow = this.getRowById(from_row_id)

 if (!this.isTreeGrid())
 for (var i = 0;i < frRow.cells.length;i++){this.cells(to_row_id, i).setValue(this.cells(from_row_id, i).getValue())
 }else
 this._copyTreeGridRowContent(frRow, from_row_id, to_row_id);if (!_isIE)this.getRowById(from_row_id).cells[0].height=frRow.cells[0].offsetHeight
 };this.setFooterLabel=function(c, label, ind){return this.setColumnLabel(c,label,ind,this.ftr)};this.setColumnLabel=function(c, label, ind, hdr){var z = (hdr||this.hdr).rows[ind||1];var col = (z._childIndexes ? z._childIndexes[c] : c);if (!z.cells[col])return;if (!this.useImagesInHeader){var hdrHTML = "<div class='hdrcell'>"

 if (label.indexOf('img:[')!= -1){var imUrl = label.replace(/.*\[([^>]+)\].*/, "$1");label=label.substr(label.indexOf("]")+1, label.length)
 hdrHTML+="<img width='18px' height='18px' align='absmiddle' src='"+imUrl+"' hspace='2'>"
 };hdrHTML+=label;hdrHTML+="</div>";z.cells[col].innerHTML=hdrHTML;if (this._hstyles[col])z.cells[col].style.cssText=this._hstyles[col]}else {z.cells[col].style.textAlign="left";z.cells[col].innerHTML="<img src='"+this.imgURL+""+label+"' onerror='this.src = \""+this.imgURL
 +"imageloaderror.gif\"'>";var a = new Image();a.src=this.imgURL+""+label.replace(/(\.[a-z]+)/, ".des$1");this.preloadImagesAr[this.preloadImagesAr.length]=a;var b = new Image();b.src=this.imgURL+""+label.replace(/(\.[a-z]+)/, ".asc$1");this.preloadImagesAr[this.preloadImagesAr.length]=b};if ((label||"").indexOf("#") != -1){var t = label.match(/(^|{)#([^}]+)(}|$)/);if (t){var tn = "_in_header_"+t[2];if (this[tn])this[tn]((this.forceDivInHeader ? z.cells[col].firstChild : z.cells[col]), col, label.split(t[0]))}}};this.clearAll=function(header){if (!this.obj.rows[0])return;if (this._h2){this._h2=new dhtmlxHierarchy();if (this._fake){if (this._realfake)this._h2=this._fake._h2;else
 this._fake._h2=this._h2}};this.limit=this._limitC=0;this.editStop(true);if (this._dLoadTimer)window.clearTimeout(this._dLoadTimer);if (this._dload){this.objBox.scrollTop=0;this.limit=this._limitC||0;this._initDrF=true};var len = this.rowsCol.length;len=this.obj.rows.length;for (var i = len-1;i > 0;i--){var t_r = this.obj.rows[i];t_r.parentNode.removeChild(t_r)};if (header){this._master_row=null;this.obj.rows[0].parentNode.removeChild(this.obj.rows[0]);for (var i = this.hdr.rows.length-1;i >= 0;i--){var t_r = this.hdr.rows[i];t_r.parentNode.removeChild(t_r)};if (this.ftr){this.ftr.parentNode.removeChild(this.ftr);this.ftr=null};this._aHead=this.ftr=this.cellWidth=this.cellType=this._aFoot=null;this._hrrar=[];this.columnIds=[];this.combos=[]};this.row=null;this.cell=null;this.rowsCol=dhtmlxArray()
 this.rowsAr=[];this._RaSeCol=[];this.rowsBuffer=dhtmlxArray()
 this.UserData=[]
 this.selectedRows=dhtmlxArray();if (this.pagingOn || this._srnd)this.xmlFileUrl="";if (this.pagingOn)this.changePage(1);if (this._contextCallTimer)window.clearTimeout(this._contextCallTimer);if (this._sst)this.enableStableSorting(true);this._fillers=this.undefined;this.setSortImgState(false);this.setSizes();this.callEvent("onClearAll", [])};this.sortField=function(ind, repeatFl, r_el){if (this.getRowsNum()== 0)
 return false;var el = this.hdr.rows[0].cells[ind];if (!el)return;if (el.tagName == "TH"&&(this.fldSort.length-1)>= el._cellIndex
 &&this.fldSort[el._cellIndex] != 'na'){var data=this.getSortingState();var sortType= ( data[0]==ind && data[1]=="asc" ) ? "des" : "asc";if (!this.callEvent("onBeforeSorting", [
 ind,
 this.fldSort[ind],
 sortType
 ]))
 return;this.sortImg.src=this.imgURL+"sort_"+(sortType == "asc" ? "asc" : "desc")+".gif";if (this.useImagesInHeader){var cel = this.hdr.rows[1].cells[el._cellIndex].firstChild;if (this.fldSorted != null){var celT = this.hdr.rows[1].cells[this.fldSorted._cellIndex].firstChild;celT.src=celT.src.replace(/(\.asc\.)|(\.des\.)/, ".")};cel.src=cel.src.replace(/(\.[a-z]+)$/, "."+sortType+"$1")
 };this.sortRows(el._cellIndex, this.fldSort[el._cellIndex], sortType)
 this.fldSorted=el;this.r_fldSorted=r_el;var c = this.hdr.rows[1];var c = r_el.parentNode;var real_el = c._childIndexes ? c._childIndexes[el._cellIndex] : el._cellIndex;this.setSortImgPos(false, false, false, r_el)}};this.setCustomSorting=function(func, col){if (!this._customSorts)this._customSorts=new Array();this._customSorts[col]=( typeof (func) == "string") ? eval(func) : func;this.fldSort[col]="cus"};this.enableHeaderImages=function(fl){this.useImagesInHeader=fl};this.setHeader=function(hdrStr, splitSign, styles){if (typeof (hdrStr)!= "object")
 var arLab = this._eSplit(hdrStr);else
 arLab=[].concat(hdrStr);var arWdth = new Array(0);var arTyp = new dhtmlxArray(0);var arAlg = new Array(0);var arVAlg = new Array(0);var arSrt = new Array(0);for (var i = 0;i < arLab.length;i++){arWdth[arWdth.length]=Math.round(100 / arLab.length);arTyp[arTyp.length]="ed";arAlg[arAlg.length]="left";arVAlg[arVAlg.length]="";arSrt[arSrt.length]="na"};this.splitSign=splitSign||"#cspan";this.hdrLabels=arLab;this.cellWidth=arWdth;if (!this.initCellWidth.length)this.setInitWidthsP(arWdth.join(this.delim),true);this.cellType=arTyp;this.cellAlign=arAlg;this.cellVAlign=arVAlg;this.fldSort=arSrt;this._hstyles=styles||[]};this._eSplit=function(str){if (![].push)return str.split(this.delim);var a = "r"+(new Date()).valueOf();var z = this.delim.replace(/([\|\+\*\^])/g, "\\$1")
 return (str||"").replace(RegExp(z, "g"), a).replace(RegExp("\\\\"+a, "g"), this.delim).split(a)};this.getColType=function(cInd){return this.cellType[cInd]};this.getColTypeById=function(cID){return this.cellType[this.getColIndexById(cID)]};this.setColTypes=function(typeStr){this.cellType=dhtmlxArray(typeStr.split(this.delim));this._strangeParams=new Array();for (var i = 0;i < this.cellType.length;i++){if ((this.cellType[i].indexOf("[")!= -1)){var z = this.cellType[i].split(/[\[\]]+/g);this.cellType[i]=z[0];this.defVal[i]=z[1];if (z[1].indexOf("=")== 0){this.cellType[i]="math";this._strangeParams[i]=z[0]}};if (!window["eXcell_"+this.cellType[i]])dhtmlxError.throwError("Configuration","Incorrect cell type: "+this.cellType[i],[this,this.cellType[i]])}};this.setColSorting=function(sortStr){this.fldSort=sortStr.split(this.delim)


 for (var i = 0;i < this.fldSort.length;i++)if (((this.fldSort[i]).length > 4)&&( typeof (window[this.fldSort[i]]) == "function")){if (!this._customSorts)this._customSorts=new Array();this._customSorts[i]=window[this.fldSort[i]];this.fldSort[i]="cus"}};this.setColAlign=function(alStr){this.cellAlign=alStr.split(this.delim)
 };this.setColVAlign=function(valStr){this.cellVAlign=valStr.split(this.delim)
 };this.setNoHeader=function(fl){this.noHeader=convertStringToBoolean(fl)};this.showRow=function(rowID){this.getRowById(rowID)

 if (this._h2)this.openItem(this._h2.get[rowID].parent.id);var c = this.getRowById(rowID).childNodes[0];while (c&&c.style.display == "none")c=c.nextSibling;if (c)this.moveToVisible(c, true)
 };this.setStyle=function(ss_header, ss_grid, ss_selCell, ss_selRow){this.ssModifier=[
 ss_header,
 ss_grid,
 ss_selCell,
 ss_selCell,
 ss_selRow
 ];var prefs = ["#"+this.entBox.id+" table.hdr td", "#"+this.entBox.id+" table.obj td",
 "#"+this.entBox.id+" table.obj tr.rowselected td.cellselected",
 "#"+this.entBox.id+" table.obj td.cellselected", "#"+this.entBox.id+" table.obj tr.rowselected td"];for (var i = 0;i < prefs.length;i++)if (this.ssModifier[i]){if (_isIE)document.styleSheets[0].addRule(prefs[i], this.ssModifier[i]);else
 document.styleSheets[0].insertRule(prefs[i]+" {"+this.ssModifier[i]+" };", 0)}};this.setColumnColor=function(clr){this.columnColor=clr.split(this.delim)
 };this.enableAlterCss=function(cssE, cssU, perLevel, levelUnique){if (cssE||cssU)this.attachEvent("onGridReconstructed",function(){this._fixAlterCss();if (this._fake)this._fake._fixAlterCss()});this._cssSP=perLevel;this._cssSU=levelUnique;this._cssEven=cssE;this._cssUnEven=cssU};this._fixAlterCss=function(ind){if (this._cssSP&&this._h2)return this._fixAlterCssTGR(ind);if (!this._cssEven && !this._cssUnEven)return;ind=ind||0;var j = ind;for (var i = ind;i < this.rowsCol.length;i++){if (!this.rowsCol[i])continue;if (this.rowsCol[i].style.display != "none"){if (this.rowsCol[i].className.indexOf("rowselected")!= -1){if (j%2 == 1)this.rowsCol[i].className=this._cssUnEven+" rowselected "+(this.rowsCol[i]._css||"");else
 this.rowsCol[i].className=this._cssEven+" rowselected "+(this.rowsCol[i]._css||"")}else {if (j%2 == 1)this.rowsCol[i].className=this._cssUnEven+" "+(this.rowsCol[i]._css||"");else
 this.rowsCol[i].className=this._cssEven+" "+(this.rowsCol[i]._css||"")};j++}}};this.clearChangedState=function(){for (var i = 0;i < this.rowsCol.length;i++){var row = this.rowsCol[i];var cols = row.childNodes.length;for (var j = 0;j < cols;j++)row.childNodes[j].wasChanged=false}};this.getChangedRows=function(and_added){var res = new Array();this.forEachRow(function(id){var row = this.rowsAr[id];if (row.tagName!="TR")return;var cols = row.childNodes.length;if (and_added && row._added)res[res.length]=row.idd;else
 for (var j = 0;j < cols;j++)if (row.childNodes[j].wasChanged){res[res.length]=row.idd;break}})
 return res.join(this.delim)};this._sUDa=false;this._sAll=false;this.setSerializationLevel=function(userData, fullXML, config, changedAttr, onlyChanged, asCDATA){this._sUDa=userData;this._sAll=fullXML;this._sConfig=config;this._chAttr=changedAttr;this._onlChAttr=onlyChanged;this._asCDATA=asCDATA};this.setSerializableColumns=function(list){if (!list){this._srClmn=null;return};this._srClmn=(list||"").split(",");for (var i = 0;i < this._srClmn.length;i++)this._srClmn[i]=convertStringToBoolean(this._srClmn[i])};this._serialise=function(rCol, inner, closed){this.editStop()
 var out = [];var close = "</"+this.xml.s_row+">"

 if (this.isTreeGrid()){this._h2.forEachChildF(0, function(el){var temp = this._serializeRow(this.render_row_tree(-1, el.id));out.push(temp);if (temp)return true;else
 return false}, this, function(){out.push(close)})}else
 for (var i = 0;i < this.rowsBuffer.length;i++)if (this.rowsBuffer[i]){var temp = this._serializeRow(this.render_row(i));out.push(temp);if (temp)out.push(close)};return [out.join("")]};this._serializeRow=function(r, i){var out = [];var ra = this.xml.row_attrs;var ca = this.xml.cell_attrs;out.push("<"+this.xml.s_row);out.push(" id='"+r.idd+"'");if ((this._sAll)&&this.selectedRows._dhx_find(r) != -1)
 out.push(" selected='1'");if (this._h2&&this._h2.get[r.idd].state == "minus")out.push(" open='1'");if (ra.length)for (var i = 0;i < ra.length;i++)out.push(" "+ra[i]+"='"+r._attrs[ra[i]]+"'");out.push(">");if (this._sUDa&&this.UserData[r.idd]){keysAr=this.UserData[r.idd].getKeys()

 for (var ii = 0;ii < keysAr.length;ii++)out.push("<userdata name='"+keysAr[ii]+"'>"+(this._asCDATA?"<![CDATA[":"")+this.UserData[r.idd].get(keysAr[ii])+(this._asCDATA?"]]>":"")+"</userdata>")};var changeFl = false;for (var jj = 0;jj < this._cCount;jj++){if ((!this._srClmn)||(this._srClmn[jj])){var zx = this.cells3(r, jj);out.push("<cell");if (ca.length)for (var i = 0;i < ca.length;i++)out.push(" "+ca[i]+"='"+zx.cell._attrs[ca[i]]+"'");zxVal=zx[this._agetm]();if (this._asCDATA)zxVal="<![CDATA["+zxVal+"]]>";if ((this._ecspn)&&(zx.cell.colSpan)&&zx.cell.colSpan > 1)
 out.push(" colspan=\""+zx.cell.colSpan+"\" ");if (this._chAttr){if (zx.wasChanged()){out.push(" changed=\"1\"");changeFl=true}}else if ((this._onlChAttr)&&(zx.wasChanged()))
 changeFl=true;if (this._sAll && this.cellType[jj]=="tree")out.push((this._h2 ? (" image='"+this._h2.get[r.idd].image+"'") : "")+">"+zxVal+"</cell>");else
 out.push(">"+zxVal+"</cell>");if ((this._ecspn)&&(zx.cell.colSpan))
 for (var u = 0;u < zx.cell.colSpan-1;u++){out.push("<cell/>");jj++}}};if ((this._onlChAttr)&&(!changeFl)&&(!r._added))
 return "";return out.join("")};this._serialiseConfig=function(){var out = "<head>";for (var i = 0;i < this.hdr.rows[0].cells.length;i++){if (this._srClmn && !this._srClmn[i])continue;var sort = this.fldSort[i];if (sort == "cus"){sort = this._customSorts[i].toString();sort=sort.replace(/function[\ ]*/,"").replace(/\([^\f]*/,"")};out+="<column width='"+this.getColWidth(i)+"' align='"+this.cellAlign[i]+"' type='"+this.cellType[i]
 +"' sort='"+(sort||"na")+"' color='"+this.columnColor[i]+"'"
 +(this.columnIds[i]
 ? (" id='"+this.columnIds[i]+"'")
 : "")+">";if (this._asCDATA)out+="<![CDATA["+this.getHeaderCol(i)+"]]>";else
 out+=this.getHeaderCol(i);var z = this.getCombo(i);if (z)for (var j = 0;j < z.keys.length;j++)out+="<option value='"+z.keys[j]+"'>"+z.values[j]+"</option>";out+="</column>"
 };return out+="</head>"};this.serialize=function(){var out = '<?xml version="1.0"?><rows>';if (this._mathSerialization)this._agetm="getMathValue";else
 this._agetm="getValue";if (this._sUDa&&this.UserData["gridglobaluserdata"]){var keysAr = this.UserData["gridglobaluserdata"].getKeys()

 for (var i = 0;i < keysAr.length;i++)out+="<userdata name='"+keysAr[i]+"'>"+this.UserData["gridglobaluserdata"].get(keysAr[i])
 +"</userdata>"};if (this._sConfig)out+=this._serialiseConfig();out+=this._serialise();out+='</rows>';return out};this.getPosition=function(oNode, pNode){if (!pNode && !_isChrome){var pos = getOffset(oNode);return [pos.left, pos.top]};var oCurrentNode = oNode;var iLeft = 0;var iTop = 0;while ((oCurrentNode)&&(oCurrentNode != pNode)){iLeft+=oCurrentNode.offsetLeft-oCurrentNode.scrollLeft;iTop+=oCurrentNode.offsetTop-oCurrentNode.scrollTop;oCurrentNode=oCurrentNode.offsetParent};if (pNode == document.body){if (_isIE){iTop+=document.body.offsetTop||document.documentElement.offsetTop;iLeft+=document.body.offsetLeft||document.documentElement.offsetLeft}else if (!_isFF){iLeft+=document.body.offsetLeft;iTop+=document.body.offsetTop}};return [iLeft, iTop]};this.getFirstParentOfType=function(obj, tag){while (obj&&obj.tagName != tag&&obj.tagName != "BODY"){obj=obj.parentNode};return obj};this.objBox.onscroll=function(){this.grid._doOnScroll()};if ((!_isOpera)||(_OperaRv > 8.5)){this.hdr.onmousemove=function(e){this.grid.changeCursorState(e||window.event)};this.hdr.onmousedown=function(e){return this.grid.startColResize(e||window.event)}};this.obj.onmousemove=this._drawTooltip;this.obj.onclick=function(e){this.grid._doClick(e||window.event);if (this.grid._sclE)this.grid.editCell(e||window.event);(e||event).cancelBubble=true};if (_isMacOS){this.entBox.oncontextmenu=function(e){return this.grid._doContClick(e||window.event)}}else {this.entBox.onmousedown=function(e){return this.grid._doContClick(e||window.event)};this.entBox.oncontextmenu=function(e){(e||event).cancelBubble=true;return !this._ctmndx}};this.obj.ondblclick=function(e){if (!this.grid.wasDblClicked(e||window.event)) 
 return false;if (this.grid._dclE)this.grid.editCell(e||window.event);(e||event).cancelBubble=true;if (_isOpera)return false};this.hdr.onclick=this._onHeaderClick;this.sortImg.onclick=function(){self._onHeaderClick.apply({grid: self
 }, [
 null,
 self.r_fldSorted
 ])};this.hdr.ondblclick=this._onHeaderDblClick;if (!document.body._dhtmlxgrid_onkeydown){dhtmlxEvent(document, _isOpera?"keypress":"keydown",function(e){if (globalActiveDHTMLGridObject)return globalActiveDHTMLGridObject.doKey(e||window.event)});document.body._dhtmlxgrid_onkeydown=true};dhtmlxEvent(document.body, "click", function(){if (self.editStop)self.editStop()});this.entBox.onbeforeactivate=function(){this._still_active=null;this.grid.setActive();event.cancelBubble=true};this.entBox.onbeforedeactivate=function(){if (this.grid._still_active)this.grid._still_active=null;else 
 this.grid.isActive=false;event.cancelBubble=true};if (this.entBox.style.height.toString().indexOf("%") != -1)
 this._delta_y = this.entBox.style.height;if (this.entBox.style.width.toString().indexOf("%") != -1)
 this._delta_x = this.entBox.style.width;if (this._delta_x||this._delta_y)this._setAutoResize();this.setColHidden=this.setColumnsVisibility
 this.enableCollSpan = this.enableColSpan
 this.setMultiselect=this.enableMultiselect;this.setMultiLine=this.enableMultiline;this.deleteSelectedItem=this.deleteSelectedRows;this.getSelectedId=this.getSelectedRowId;this.getHeaderCol=this.getColumnLabel;this.isItemExists=this.doesRowExist;this.getColumnCount=this.getColumnsNum;this.setSelectedRow=this.selectRowById;this.setHeaderCol=this.setColumnLabel;this.preventIECashing=this.preventIECaching;this.enableAutoHeigth=this.enableAutoHeight;this.getUID=this.uid;if (dhtmlx.image_path)this.setImagePath(dhtmlx.image_path);if (dhtmlx.skin)this.setSkin(dhtmlx.skin);return this};dhtmlXGridObject.prototype={getRowAttribute: function(id, name){return this.getRowById(id)._attrs[name]},
 setRowAttribute: function(id, name, value){this.getRowById(id)._attrs[name]=value},
 
 isTreeGrid:function(){return (this.cellType._dhx_find("tree") != -1)},
 

 
 setRowHidden:function(id, state){var f = convertStringToBoolean(state);var row = this.getRowById(id) 
 
 if (!row)return;if (row.expand === "")this.collapseKids(row);if ((state)&&(row.style.display != "none")){row.style.display="none";var z = this.selectedRows._dhx_find(row);if (z != -1){row.className=row.className.replace("rowselected", "");for (var i = 0;i < row.childNodes.length;i++)row.childNodes[i].className=row.childNodes[i].className.replace(/cellselected/g, "");this.selectedRows._dhx_removeAt(z)};this.callEvent("onGridReconstructed", [])};if ((!state)&&(row.style.display == "none")){row.style.display="";this.callEvent("onGridReconstructed", [])};this.setSizes()},
 

 
 setColumnHidden:function(ind, state){if (!this.hdr.rows.length){if (!this._ivizcol)this._ivizcol=[];return this._ivizcol[ind]=state};if ((this.fldSorted)&&(this.fldSorted.cellIndex == ind)&&(state))
 this.sortImg.style.display="none";var f = convertStringToBoolean(state);if (f){if (!this._hrrar)this._hrrar=new Array();else if (this._hrrar[ind])return;this._hrrar[ind]="display:none;";this._hideShowColumn(ind, "none")}else {if ((!this._hrrar)||(!this._hrrar[ind]))
 return;this._hrrar[ind]="";this._hideShowColumn(ind, "")};if ((this.fldSorted)&&(this.fldSorted.cellIndex == ind)&&(!state))
 this.sortImg.style.display="inline";this.setSortImgPos();this.callEvent("onColumnHidden",[ind,state])
 },
 
 
 
 isColumnHidden:function(ind){if ((this._hrrar)&&(this._hrrar[ind]))
 return true;return false},
 
 setColumnsVisibility:function(list){if (list)this._ivizcol=list.split(this.delim);if (this.hdr.rows.length&&this._ivizcol)for (var i = 0;i < this._ivizcol.length;i++)this.setColumnHidden(i, this._ivizcol[i])},
 
 _fixHiddenRowsAll:function(pb, ind, prop, state, index){index=index||"_cellIndex";var z = pb.rows.length;for (var i = 0;i < z;i++){var x = pb.rows[i].childNodes;if (x.length != this._cCount){for (var j = 0;j < x.length;j++)if (x[j][index] == ind){x[j].style[prop]=state;break}}else
 x[ind].style[prop]=state}},
 
 _hideShowColumn:function(ind, state){var hind = ind;if ((this.hdr.rows[1]._childIndexes)&&(this.hdr.rows[1]._childIndexes[ind] != ind))
 hind=this.hdr.rows[1]._childIndexes[ind];if (state == "none"){this.hdr.rows[0].cells[ind]._oldWidth=this.hdr.rows[0].cells[ind].style.width||(this.initCellWidth[ind]+"px");this.hdr.rows[0].cells[ind]._oldWidthP=this.cellWidthPC[ind];this.obj.rows[0].cells[ind].style.width="0px";var t={rows:[this.obj.rows[0]]};this.forEachRow(function(id){if (this.rowsAr[id].tagName=="TR")t.rows.push(this.rowsAr[id])
 })
 this._fixHiddenRowsAll(t, ind, "display", "none");if (this.isTreeGrid())
 this._fixHiddenRowsAllTG(ind, "none");if ((_isOpera&&_OperaRv < 9)||_isKHTML||(_isFF)){this._fixHiddenRowsAll(this.hdr, ind, "display", "none","_cellIndexS");if (this.ftr)this._fixHiddenRowsAll(this.ftr.childNodes[0], ind, "display", "none")};this._fixHiddenRowsAll(this.hdr, ind, "whiteSpace", "nowrap","_cellIndexS");if (!this.cellWidthPX.length&&!this.cellWidthPC.length)this.cellWidthPX=[].concat(this.initCellWidth);if (this.cellWidthPX[ind])this.cellWidthPX[ind]=0;if (this.cellWidthPC[ind])this.cellWidthPC[ind]=0}else {if (this.hdr.rows[0].cells[ind]._oldWidth){var zrow = this.hdr.rows[0].cells[ind];if (_isOpera||_isKHTML||(_isFF))
 this._fixHiddenRowsAll(this.hdr, ind, "display", "","_cellIndexS");if (this.ftr)this._fixHiddenRowsAll(this.ftr.childNodes[0], ind, "display", "");var t={rows:[this.obj.rows[0]]};this.forEachRow(function(id){if (this.rowsAr[id].tagName=="TR")t.rows.push(this.rowsAr[id])
 })
 this._fixHiddenRowsAll(t, ind, "display", "");if (this.isTreeGrid())
 this._fixHiddenRowsAllTG(ind, "");this._fixHiddenRowsAll(this.hdr, ind, "whiteSpace", "normal","_cellIndexS");if (zrow._oldWidthP)this.cellWidthPC[ind]=zrow._oldWidthP;if (zrow._oldWidth)this.cellWidthPX[ind]=parseInt(zrow._oldWidth)}};this.setSizes();if ((!_isIE)&&(!_isFF)){this.obj.border=1;this.obj.border=0}},




 
 enableColSpan:function(mode){this._ecspn=convertStringToBoolean(mode)},



 
 enableRowsHover:function(mode, cssClass){this._hvrCss=cssClass;if (convertStringToBoolean(mode)){if (!this._elmnh){this.obj._honmousemove=this.obj.onmousemove;this.obj.onmousemove=this._setRowHover;if (_isIE)this.obj.onmouseleave=this._unsetRowHover;else
 this.obj.onmouseout=this._unsetRowHover;this._elmnh=true}}else {if (this._elmnh){this.obj.onmousemove=this.obj._honmousemove;if (_isIE)this.obj.onmouseleave=null;else
 this.obj.onmouseout=null;this._elmnh=false}}},

 
 enableEditEvents:function(click, dblclick, f2Key){this._sclE=convertStringToBoolean(click);this._dclE=convertStringToBoolean(dblclick);this._f2kE=convertStringToBoolean(f2Key)},
 

 
 enableLightMouseNavigation:function(mode){if (convertStringToBoolean(mode)){if (!this._elmn){this.entBox._onclick=this.entBox.onclick;this.entBox.onclick=function(){return true};this.obj._onclick=this.obj.onclick;this.obj.onclick=function(e){var c = this.grid.getFirstParentOfType(e ? e.target : event.srcElement, 'TD');if (!c)return;this.grid.editStop();this.grid.doClick(c);this.grid.editCell();(e||event).cancelBubble=true};this.obj._onmousemove=this.obj.onmousemove;this.obj.onmousemove=this._autoMoveSelect;this._elmn=true}}else {if (this._elmn){this.entBox.onclick=this.entBox._onclick;this.obj.onclick=this.obj._onclick;this.obj.onmousemove=this.obj._onmousemove;this._elmn=false}}},
 
 
 
 _unsetRowHover:function(e, c){if (c)that=this;else
 that=this.grid;if ((that._lahRw)&&(that._lahRw != c)){for (var i = 0;i < that._lahRw.childNodes.length;i++)that._lahRw.childNodes[i].className=that._lahRw.childNodes[i].className.replace(that._hvrCss, "");that._lahRw=null}},
 
 
 _setRowHover:function(e){var c = this.grid.getFirstParentOfType(e ? e.target : event.srcElement, 'TD');if (c && c.parentNode!=this.grid._lahRw){this.grid._unsetRowHover(0, c);c=c.parentNode;if (!c.idd || c.idd=="__filler__")return;for (var i = 0;i < c.childNodes.length;i++)c.childNodes[i].className+=" "+this.grid._hvrCss;this.grid._lahRw=c};this._honmousemove(e)},
 
 
 _autoMoveSelect:function(e){if (!this.grid.editor){var c = this.grid.getFirstParentOfType(e ? e.target : event.srcElement, 'TD');if (c.parentNode.idd)this.grid.doClick(c, true, 0)};this._onmousemove(e)},



 
 enableDistributedParsing:function(mode, count, time){if (convertStringToBoolean(mode)){this._ads_count=count||10;this._ads_time=time||250}else
 this._ads_count=0},


 
 destructor:function(){if (this._sizeTime)this._sizeTime=window.clearTimeout(this._sizeTime);this.entBox.className=(this.entBox.className||"").replace(/gridbox.*/,"");if (this.formInputs)for (var i = 0;i < this.formInputs.length;i++)this.parentForm.removeChild(this.formInputs[i]);var a;this.xmlLoader=this.xmlLoader.destructor();for (var i = 0;i < this.rowsCol.length;i++)if (this.rowsCol[i])this.rowsCol[i].grid=null;for (i in this.rowsAr)if (this.rowsAr[i])this.rowsAr[i]=null;this.rowsCol=new dhtmlxArray();this.rowsAr=new Array();this.entBox.innerHTML="";var dummy=function(){};this.entBox.onclick = this.entBox.onmousedown = this.entBox.onbeforeactivate = this.entBox.onbeforedeactivate = this.entBox.onbeforedeactivate = this.entBox.onselectstart = dummy;this.setSizes = this._update_srnd_view = this.callEvent = dummy;this.entBox.grid=null;for (a in this){if ((this[a])&&(this[a].m_obj))
 this[a].m_obj=null;this[a]=null};if (this == globalActiveDHTMLGridObject)globalActiveDHTMLGridObject=null;return null},
 

 
 getSortingState:function(){var z = new Array();if (this.fldSorted){z[0]=this.fldSorted._cellIndex;z[1]=(this.sortImg.src.indexOf("sort_desc.gif") != -1) ? "des" : "asc"};return z},

 
 
 enableAutoHeight:function(mode, maxHeight, countFullHeight){this._ahgr=convertStringToBoolean(mode);this._ahgrF=convertStringToBoolean(countFullHeight);this._ahgrM=maxHeight||null;if (maxHeight == "auto"){this._ahgrM=null;this._ahgrMA=true;this._setAutoResize()}},

 enableStableSorting:function(mode){this._sst=convertStringToBoolean(mode);this.rowsCol.stablesort=function(cmp){var size = this.length-1;for (var i = 0;i < this.length-1;i++){for (var j = 0;j < size;j++)if (cmp(this[j], this[j+1])> 0){var temp = this[j];this[j]=this[j+1];this[j+1]=temp};size--}}},

 
 
 enableKeyboardSupport:function(mode){this._htkebl=!convertStringToBoolean(mode)},
 

 
 enableContextMenu:function(menu){this._ctmndx=menu},

 
 
 setScrollbarWidthCorrection:function(width){},

 
 enableTooltips:function(list){this._enbTts=list.split(",");for (var i = 0;i < this._enbTts.length;i++)this._enbTts[i]=convertStringToBoolean(this._enbTts[i])},

 

 
 enableResizing:function(list){this._drsclmn=list.split(",");for (var i = 0;i < this._drsclmn.length;i++)this._drsclmn[i]=convertStringToBoolean(this._drsclmn[i])},
 
 
 setColumnMinWidth:function(width, ind){if (arguments.length == 2){if (!this._drsclmW)this._drsclmW=new Array();this._drsclmW[ind]=width}else
 this._drsclmW=width.split(",")},

 
 
 enableCellIds:function(mode){this._enbCid=convertStringToBoolean(mode)},
 
 

 
 lockRow:function(rowId, mode){var z = this.getRowById(rowId);if (z){z._locked=convertStringToBoolean(mode);if ((this.cell)&&(this.cell.parentNode.idd == rowId))
 this.editStop()}},

 
 
 _getRowArray:function(row){var text = new Array();for (var ii = 0;ii < row.childNodes.length;ii++){var a = this.cells3(row, ii);text[ii]=a.getValue()};return text},


 
 setDateFormat:function(mask,incoming){this._dtmask=mask;this._dtmask_inc=incoming},
 
 
 setNumberFormat:function(mask, cInd, p_sep, d_sep){var nmask = mask.replace(/[^0\,\.]*/g, "");var pfix = nmask.indexOf(".");if (pfix > -1)pfix=nmask.length-pfix-1;var dfix = nmask.indexOf(",");if (dfix > -1)dfix=nmask.length-pfix-2-dfix;if (typeof p_sep != "string")p_sep=this.i18n.decimal_separator;if (typeof d_sep != "string")d_sep=this.i18n.group_separator;var pref = mask.split(nmask)[0];var postf = mask.split(nmask)[1];this._maskArr[cInd]=[
 pfix,
 dfix,
 pref,
 postf,
 p_sep,
 d_sep
 ]},
 
 _aplNFb:function(data, ind){var a = this._maskArr[ind];if (!a)return data;var ndata = parseFloat(data.toString().replace(/[^0-9]*/g, ""));if (data.toString().substr(0, 1) == "-")
 ndata=ndata*-1;if (a[0] > 0)ndata=ndata / Math.pow(10, a[0]);return ndata},
 
 
 _aplNF:function(data, ind){var a = this._maskArr[ind];if (!a)return data;var c = (parseFloat(data) < 0 ? "-" : "")+a[2];data=Math.abs(Math.round(parseFloat(data)*Math.pow(10, a[0] > 0 ? a[0] : 0))).toString();data=(data.length
 < a[0]
 ? Math.pow(10, a[0]+1-data.length).toString().substr(1, a[0]+1)+data.toString()
 : data).split("").reverse();data[a[0]]=(data[a[0]]||"0")+a[4];if (a[1] > 0)for (var j = (a[0] > 0 ? 0 : 1)+a[0]+a[1];j < data.length;j+=a[1])data[j]+=a[5];return c+data.reverse().join("")+a[3]},


 

 
 
 _launchCommands:function(arr){for (var i = 0;i < arr.length;i++){var args = new Array();for (var j = 0;j < arr[i].childNodes.length;j++)if (arr[i].childNodes[j].nodeType == 1)args[args.length]=arr[i].childNodes[j].firstChild.data;this[arr[i].getAttribute("command")].apply(this, args)}},
 
 
 
 _parseHead:function(xmlDoc){var hheadCol = this.xmlLoader.doXPath("./head", xmlDoc);if (hheadCol.length){var headCol = this.xmlLoader.doXPath("./column", hheadCol[0]);var asettings = this.xmlLoader.doXPath("./settings", hheadCol[0]);var awidthmet = "setInitWidths";var split = false;if (asettings[0]){for (var s = 0;s < asettings[0].childNodes.length;s++)switch (asettings[0].childNodes[s].tagName){case "colwidth":
 if (asettings[0].childNodes[s].firstChild&&asettings[0].childNodes[s].firstChild.data == "%")awidthmet="setInitWidthsP";break;case "splitat":
 split=(asettings[0].childNodes[s].firstChild ? asettings[0].childNodes[s].firstChild.data : false);break}};this._launchCommands(this.xmlLoader.doXPath("./beforeInit/call", hheadCol[0]));if (headCol.length > 0){if (this.hdr.rows.length > 0)this.clearAll(true);var sets = [
 [],
 [],
 [],
 [],
 [],
 [],
 [],
 [],
 []
 ];var attrs = ["", "width", "type", "align", "sort", "color", "format", "hidden", "id"];var calls = ["setHeader", awidthmet, "setColTypes", "setColAlign", "setColSorting", "setColumnColor", "",
 "", "setColumnIds"];for (var i = 0;i < headCol.length;i++){for (var j = 1;j < attrs.length;j++)sets[j].push(headCol[i].getAttribute(attrs[j]));sets[0].push((headCol[i].firstChild
 ? headCol[i].firstChild.data
 : "").replace(/^\s*((\s\S)*.+)\s*$/gi, "$1"))};for (var i = 0;i < calls.length;i++)if (calls[i])this[calls[i]](sets[i].join(this.delim))
 
 for (var i = 0;i < headCol.length;i++){if ((this.cellType[i].indexOf('co')== 0)||(this.cellType[i] == "clist")){var optCol = this.xmlLoader.doXPath("./option", headCol[i]);if (optCol.length){var resAr = new Array();if (this.cellType[i] == "clist"){for (var j = 0;j < optCol.length;j++)resAr[resAr.length]=optCol[j].firstChild
 ? optCol[j].firstChild.data
 : "";this.registerCList(i, resAr)}else {var combo = this.getCombo(i);for (var j = 0;j < optCol.length;j++)combo.put(optCol[j].getAttribute("value"),
 optCol[j].firstChild
 ? optCol[j].firstChild.data
 : "")}}}else if (sets[6][i])if ((this.cellType[i].toLowerCase().indexOf("calendar")!=-1)||(this.fldSort[i] == "date"))
 this.setDateFormat(sets[6][i], i);else
 this.setNumberFormat(sets[6][i], i)};this.init();var param=sets[7].join(this.delim);if (this.setColHidden && param.replace(/,/g,"")!="")
 this.setColHidden(param);if ((split)&&(this.splitAt))
 this.splitAt(split)};this._launchCommands(this.xmlLoader.doXPath("./afterInit/call", hheadCol[0]))};var gudCol = this.xmlLoader.doXPath("//rows/userdata", xmlDoc);if (gudCol.length > 0){if (!this.UserData["gridglobaluserdata"])this.UserData["gridglobaluserdata"]=new Hashtable();for (var j = 0;j < gudCol.length;j++){this.UserData["gridglobaluserdata"].put(gudCol[j].getAttribute("name"),
 gudCol[j].firstChild
 ? gudCol[j].firstChild.data
 : "")}}},
 
 

 
 
 
 getCheckedRows:function(col_ind){var d = new Array();this.forEachRowA(function(id){if (this.cells(id, col_ind).getValue() != 0)
 d.push(id)},true)
 return d.join(",")},
 
 checkAll:function(){var mode=arguments.length?arguments[0]:1;for (var cInd=0;cInd<this.getColumnsNum();cInd++){if(this.getColType(cInd)=="ch")this.setCheckedRows(cInd,mode)}},
 
 uncheckAll:function(){this.checkAll(0)},
 
 setCheckedRows:function(cInd,v){this.forEachRow(function(id){if(this.cells(id,cInd).isCheckbox())this.cells(id,cInd).setValue(v)})},

 
 _drawTooltip:function(e){var c = this.grid.getFirstParentOfType(e ? e.target : event.srcElement, 'TD');if (!c || ((this.grid.editor)&&(this.grid.editor.cell == c)))
 return true;var r = c.parentNode;if (!r.idd||r.idd == "__filler__")return;var el = (e ? e.target : event.srcElement);if (r.idd == window.unknown)return true;if (!this.grid.callEvent("onMouseOver", [
 r.idd,
 c._cellIndex
 ]))
 return true;if ((this.grid._enbTts)&&(!this.grid._enbTts[c._cellIndex])){if (el.title)el.title='';return true};if (c._cellIndex >= this.grid._cCount)return;var ced = this.grid.cells3(r, c._cellIndex);if (!ced || !ced.cell || !ced.cell._attrs)return;if (el._title)ced.cell.title="";if (!ced.cell._attrs['title'])el._title=true;if (ced)el.title=ced.cell._attrs['title']
 ||(ced.getTitle
 ? ced.getTitle()
 : (ced.getValue()||"").toString().replace(/<[^>]*>/gi, ""));return true},

 
 enableCellWidthCorrection:function(size){if (_isFF)this._wcorr=parseInt(size)},
 
 
 
 getAllRowIds:function(separator){var ar = [];for (var i = 0;i < this.rowsBuffer.length;i++)if (this.rowsBuffer[i])ar.push(this.rowsBuffer[i].idd);return ar.join(separator||this.delim)
 },
 getAllItemIds:function(){return this.getAllRowIds()},
 


 
 
 setColspan:function(row_id, col_ind, colspan){if (!this._ecspn)return;var r = this.getRowById(row_id);if ((r._childIndexes)&&(r.childNodes[r._childIndexes[col_ind]])){var j = r._childIndexes[col_ind];var n = r.childNodes[j];var m = n.colSpan;n.colSpan=1;if ((m)&&(m != 1))
 for (var i = 1;i < m;i++){var c = document.createElement("TD");if (n.nextSibling)r.insertBefore(c, n.nextSibling);else
 r.appendChild(c);r._childIndexes[col_ind+i]=j+i;c._cellIndex=col_ind+i;c.style.textAlign=this.cellAlign[i];c.style.verticalAlign=this.cellVAlign[i];n=c;this.cells3(r, col_ind+i).setValue("")};for (var z = col_ind*1+1*m;z < r._childIndexes.length;z++){r._childIndexes[z]+=(m-1)*1}};if ((colspan)&&(colspan > 1)){if (r._childIndexes)var j = r._childIndexes[col_ind];else {var j = col_ind;r._childIndexes=new Array();for (var z = 0;z < r.childNodes.length;z++)r._childIndexes[z]=z};r.childNodes[j].colSpan=colspan;for (var z = 1;z < colspan;z++){r._childIndexes[r.childNodes[j+1]._cellIndex]=j;r.removeChild(r.childNodes[j+1])};var c1 = r.childNodes[r._childIndexes[col_ind]]._cellIndex;for (var z = c1*1+1*colspan;z < r._childIndexes.length;z++)r._childIndexes[z]-=(colspan-1)}},
 


 
 
 preventIECaching:function(mode){this.no_cashe=convertStringToBoolean(mode);this.xmlLoader.rSeed=this.no_cashe},
 enableColumnAutoSize:function(mode){this._eCAS=convertStringToBoolean(mode)},
 
 _onHeaderDblClick:function(e){var that = this.grid;var el = that.getFirstParentOfType(_isIE ? event.srcElement : e.target, "TD");if (!that._eCAS)return false;that.adjustColumnSize(el._cellIndexS)
 },
 
 
 adjustColumnSize:function(cInd, complex){if (this._hrrar && this._hrrar[cInd])return;this._notresize=true;var m = 0;this._setColumnSizeR(cInd, 20);for (var j = 1;j < this.hdr.rows.length;j++){var a = this.hdr.rows[j];a=a.childNodes[(a._childIndexes) ? a._childIndexes[cInd] : cInd];if ((a)&&((!a.colSpan)||(a.colSpan < 2)) && a._cellIndex==cInd){if ((a.childNodes[0])&&(a.childNodes[0].className == "hdrcell"))
 a=a.childNodes[0];m=Math.max(m, ((_isFF||_isOpera) ? (a.textContent.length*7) : a.scrollWidth))}};var l = this.obj.rows.length;for (var i = 1;i < l;i++){var z = this.obj.rows[i];if (z._childIndexes&&z._childIndexes[cInd] != cInd || !z.childNodes[cInd])continue;if (_isFF||_isOpera||complex)z=z.childNodes[cInd].textContent.length*7;else
 z=z.childNodes[cInd].scrollWidth;if (z > m)m=z};m+=20+(complex||0);this._setColumnSizeR(cInd, m);this._notresize=false;this.setSizes()},
 

 
 detachHeader:function(index, hdr){hdr=hdr||this.hdr;var row = hdr.rows[index+1];if (row)row.parentNode.removeChild(row);this.setSizes()},
 
 
 detachFooter:function(index){this.detachHeader(index, this.ftr)},
 
 
 attachHeader:function(values, style, _type){if (typeof (values)== "string")
 values=this._eSplit(values);if (typeof (style)== "string")
 style=style.split(this.delim);_type=_type||"_aHead";if (this.hdr.rows.length){if (values)this._createHRow([
 values,
 style
 ], this[(_type == "_aHead") ? "hdr" : "ftr"]);else if (this[_type])for (var i = 0;i < this[_type].length;i++)this.attachHeader.apply(this, this[_type][i])}else {if (!this[_type])this[_type]=new Array();this[_type][this[_type].length]=[
 values,
 style,
 _type
 ]}},
 
 _createHRow:function(data, parent){if (!parent){if (this.entBox.style.position!="absolute")this.entBox.style.position="relative";var z = document.createElement("DIV");z.className="c_ftr".substr(2);this.entBox.appendChild(z);var t = document.createElement("TABLE");t.cellPadding=t.cellSpacing=0;if (!_isIE){t.width="100%";t.style.paddingRight="20px"};t.style.marginRight="20px";t.style.tableLayout="fixed";z.appendChild(t);t.appendChild(document.createElement("TBODY"));this.ftr=parent=t;var hdrRow = t.insertRow(0);var thl = ((this.hdrLabels.length <= 1) ? data[0].length : this.hdrLabels.length);for (var i = 0;i < thl;i++){hdrRow.appendChild(document.createElement("TH"));hdrRow.childNodes[i]._cellIndex=i};if (_isIE && _isIE<8)hdrRow.style.position="absolute";else
 hdrRow.style.height='auto'};var st1 = data[1];var z = document.createElement("TR");parent.rows[0].parentNode.appendChild(z);for (var i = 0;i < data[0].length;i++){if (data[0][i] == "#cspan"){var pz = z.cells[z.cells.length-1];pz.colSpan=(pz.colSpan||1)+1;continue};if ((data[0][i] == "#rspan")&&(parent.rows.length > 1)){var pind = parent.rows.length-2;var found = false;var pz = null;while (!found){var pz = parent.rows[pind];for (var j = 0;j < pz.cells.length;j++)if (pz.cells[j]._cellIndex == i){found=j+1;break};pind--};pz=pz.cells[found-1];pz.rowSpan=(pz.rowSpan||1)+1;continue};var w = document.createElement("TD");w._cellIndex=w._cellIndexS=i;if (this._hrrar && this._hrrar[i] && !_isIE)w.style.display='none';if (typeof data[0][i] == "object")w.appendChild(data[0][i]);else {if (this.forceDivInHeader)w.innerHTML="<div class='hdrcell'>"+(data[0][i]||"&nbsp;")+"</div>";else
 w.innerHTML=(data[0][i]||"&nbsp;");if ((data[0][i]||"").indexOf("#") != -1){var t = data[0][i].match(/(^|{)#([^}]+)(}|$)/);if (t){var tn = "_in_header_"+t[2];if (this[tn])this[tn]((this.forceDivInHeader ? w.firstChild : w), i, data[0][i].split(t[0]))}}};if (st1)w.style.cssText=st1[i];z.appendChild(w)};var self = parent;if (_isKHTML){if (parent._kTimer)window.clearTimeout(parent._kTimer);parent._kTimer=window.setTimeout(function(){parent.rows[1].style.display='none';window.setTimeout(function(){parent.rows[1].style.display=''}, 1)}, 500)}},

 
 attachFooter:function(values, style){this.attachHeader(values, style, "_aFoot")},




 
 setCellExcellType:function(rowId, cellIndex, type){this.changeCellType(this.rowsAr[rowId], cellIndex, type)},
 
 changeCellType:function(r, ind, type){type=type||this.cellType[ind];var z = this.cells3(r, ind);var v = z.getValue();z.cell._cellType=type;var z = this.cells3(r, ind);z.setValue(v)},
 
 setRowExcellType:function(rowId, type){var z = this.rowsAr[rowId];for (var i = 0;i < z.childNodes.length;i++)this.changeCellType(z, i, type)},
 
 setColumnExcellType:function(colIndex, type){for (var i = 0;i < this.rowsBuffer.length;i++)if (this.rowsBuffer[i] && this.rowsBuffer[i].tagName=="TR")this.changeCellType(this.rowsBuffer[i], colIndex, type);if (this.cellType[colIndex]=="math")this._strangeParams[i]=type;else
 this.cellType[colIndex]=type},
 



 
 forEachRow:function(custom_code){for (var a in this.rowsAr)if (this.rowsAr[a]&&this.rowsAr[a].idd)custom_code.apply(this, [this.rowsAr[a].idd])},
 forEachRowA:function(custom_code){for (var a =0;a<this.rowsBuffer.length;a++){if (this.rowsBuffer[a])custom_code.call(this, this.render_row(a).idd)}},
 
 forEachCell:function(rowId, custom_code){var z = this.getRowById(rowId);if (!z)return;for (var i = 0;i < this._cCount;i++)custom_code(this.cells3(z, i),i)},
 
 enableAutoWidth:function(mode, max_limit, min_limit){this._awdth=[
 convertStringToBoolean(mode),
 parseInt(max_limit||99999),
 parseInt(min_limit||0)
 ]},

 
 
 updateFromXML:function(url, insert_new, del_missed, afterCall){if (typeof insert_new == "undefined")insert_new=true;this._refresh_mode=[
 true,
 insert_new,
 del_missed
 ];this.load(url,afterCall)
 },
 _refreshFromXML:function(xml){reset = false;if (window.eXcell_tree){eXcell_tree.prototype.setValueX=eXcell_tree.prototype.setValue;eXcell_tree.prototype.setValue=function(content){var r=this.grid._h2.get[this.cell.parentNode.idd]
 if (r && this.cell.parentNode.valTag){this.setLabel(content)}else
 this.setValueX(content)}};var tree = this.cellType._dhx_find("tree");xml.getXMLTopNode("rows");var pid = xml.doXPath("//rows")[0].getAttribute("parent")||0;var del = {};if (this._refresh_mode[2]){if (tree != -1)this._h2.forEachChild(pid, function(obj){del[obj.id]=true}, this);else
 this.forEachRow(function(id){del[id]=true})};var rows = xml.doXPath("//row");for (var i = 0;i < rows.length;i++){var row = rows[i];var id = row.getAttribute("id");del[id]=false;var pid = row.parentNode.getAttribute("id")||pid;if (this.rowsAr[id] && this.rowsAr[id].tagName!="TR"){if (this._h2)this._h2.get[id].buff.data=row;else
 this.rowsBuffer[this.getRowIndex(id)].data=row;this.rowsAr[id]=row}else if (this.rowsAr[id]){this._process_xml_row(this.rowsAr[id], row, -1);this._postRowProcessing(this.rowsAr[id],true)
 }else if (this._refresh_mode[1]){var dadd={idd: id,
 data: row,
 _parser: this._process_xml_row,
 _locator: this._get_xml_data
 };if (this._refresh_mode[1]=="top")this.rowsBuffer.unshift(dadd);else
 this.rowsBuffer.push(dadd);if (this._h2){reset=true;(this._h2.add(id,(row.parentNode.getAttribute("id")||row.parentNode.getAttribute("parent")))).buff=this.rowsBuffer[this.rowsBuffer.length-1]};this.rowsAr[id]=row;row=this.render_row(this.rowsBuffer.length-1);this._insertRowAt(row,-1)
 }};if (this._refresh_mode[2])for (id in del){if (del[id]&&this.rowsAr[id])this.deleteRow(id)};this._refresh_mode=null;if (window.eXcell_tree)eXcell_tree.prototype.setValue=eXcell_tree.prototype.setValueX;if (reset)this._renderSort();this.callEvent("onXLE", [
 this,
 rows.length
 ])},


 
 getCustomCombo:function(id, ind){var cell = this.cells(id, ind).cell;if (!cell._combo)cell._combo=new dhtmlXGridComboObject();return cell._combo},

 
 setTabOrder:function(order){var t = order.split(this.delim);this._tabOrder=[];var max=this._cCount||order.length;for (var i = 0;i < max;i++)t[i]={c: parseInt(t[i]),
 ind: i
 };t.sort(function(a, b){return (a.c > b.c ? 1 : -1)});for (var i = 0;i < max;i++)if (!t[i+1]||( typeof t[i].c == "undefined"))
 this._tabOrder[t[i].ind]=(t[0].ind+1)*-1;else
 this._tabOrder[t[i].ind]=t[i+1].ind},
 
 i18n:{loading: "Loading",
 decimal_separator:".",
 group_separator:","
 },
 
 
 _key_events:{k13_1_0: function(){var rowInd = this.rowsCol._dhx_find(this.row)
 this.selectCell(this.rowsCol[rowInd+1], this.cell._cellIndex, true)},
 k13_0_1: function(){var rowInd = this.rowsCol._dhx_find(this.row)
 this.selectCell(this.rowsCol[rowInd-1], this.cell._cellIndex, true)},
 k13_0_0: function(){this.editStop();this.callEvent("onEnter", [
 (this.row ? this.row.idd : null),
 (this.cell ? this.cell._cellIndex : null)
 ]);this._still_active=true},
 k9_0_0: function(){this.editStop();if (!this.callEvent("onTab",[true])) return true;var z = this._getNextCell(null, 1);if (z){this.selectCell(z.parentNode, z._cellIndex, (this.row != z.parentNode), false, true);this._still_active=true}},
 k9_0_1: function(){this.editStop();if (!this.callEvent("onTab",[false])) return false;var z = this._getNextCell(null, -1);if (z){this.selectCell(z.parentNode, z._cellIndex, (this.row != z.parentNode), false, true);this._still_active=true}},
 k113_0_0: function(){if (this._f2kE)this.editCell()},
 k32_0_0: function(){var c = this.cells4(this.cell);if (!c.changeState||(c.changeState()=== false))
 return false},
 k27_0_0: function(){this.editStop(true)},
 k33_0_0: function(){if (this.pagingOn)this.changePage(this.currentPage-1);else
 this.scrollPage(-1)},
 k34_0_0: function(){if (this.pagingOn)this.changePage(this.currentPage+1);else
 this.scrollPage(1)},
 k37_0_0: function(){if (!this.editor&&this.isTreeGrid())
 this.collapseKids(this.row)
 else
 return false},
 k39_0_0: function(){if (!this.editor&&this.isTreeGrid())
 this.expandKids(this.row)
 else
 return false},
 k40_0_0: function(){var master = this._realfake?this._fake:this;if (this.editor&&this.editor.combo)this.editor.shiftNext();else {if (!this.row.idd)return;var rowInd = Math.max((master._r_select||0),this.getRowIndex(this.row.idd))+1;if (this.rowsBuffer[rowInd]){master._r_select=null;this.selectCell(rowInd, this.cell._cellIndex, true);if (master.pagingOn)master.showRow(master.getRowId(rowInd))}else {this._key_events.k34_0_0.apply(this, []);if (this.pagingOn && this.rowsCol[rowInd])this.selectCell(rowInd, 0, true)}};this._still_active=true},
 k38_0_0: function(){var master = this._realfake?this._fake:this;if (this.editor&&this.editor.combo)this.editor.shiftPrev();else {if (!this.row.idd)return;var rowInd = this.getRowIndex(this.row.idd)+1;if (rowInd != -1 && (!this.pagingOn || (rowInd!=1))){var nrow = this._nextRow(rowInd-1, -1);this.selectCell(nrow, this.cell._cellIndex, true);if (master.pagingOn && nrow)master.showRow(nrow.idd)}else {this._key_events.k33_0_0.apply(this, [])}};this._still_active=true}},
 
 
 
 _build_master_row:function(){var t = document.createElement("DIV");var html = ["<table><tr>"];for (var i = 0;i < this._cCount;i++)html.push("<td></td>");html.push("</tr></table>");t.innerHTML=html.join("");this._master_row=t.firstChild.rows[0]},
 
 _prepareRow:function(new_id){if (!this._master_row)this._build_master_row();var r = this._master_row.cloneNode(true);for (var i = 0;i < r.childNodes.length;i++){r.childNodes[i]._cellIndex=i;if (this._enbCid)r.childNodes[i].id="c_"+new_id+"_"+i;if (this.dragAndDropOff)this.dragger.addDraggableItem(r.childNodes[i], this)};r.idd=new_id;r.grid=this;return r},
 

 _process_jsarray_row:function(r, data){r._attrs={};for (var j = 0;j < r.childNodes.length;j++)r.childNodes[j]._attrs={};this._fillRow(r, (this._c_order ? this._swapColumns(data) : data));return r},
 _get_jsarray_data:function(data, ind){return data[ind]},
 _process_json_row:function(r, data){r._attrs={};for (var j = 0;j < r.childNodes.length;j++)r.childNodes[j]._attrs={};this._fillRow(r, (this._c_order ? this._swapColumns(data.data) : data.data));return r},
 _get_json_data:function(data, ind){return data.data[ind]},
 
 _process_csv_row:function(r, data){r._attrs={};for (var j = 0;j < r.childNodes.length;j++)r.childNodes[j]._attrs={};this._fillRow(r, (this._c_order ? this._swapColumns(data.split(this.csv.cell)) : data.split(this.csv.cell)));return r},
 _get_csv_data:function(data, ind){return data.split(this.csv.cell)[ind]},


 _process_xml_row:function(r, xml){var cellsCol = this.xmlLoader.doXPath(this.xml.cell, xml);var strAr = [];r._attrs=this._xml_attrs(xml);if (this._ud_enabled){var udCol = this.xmlLoader.doXPath("./userdata", xml);for (var i = udCol.length-1;i >= 0;i--)this.setUserData(r.idd,udCol[i].getAttribute("name"), udCol[i].firstChild
 ? udCol[i].firstChild.data
 : "")};for (var j = 0;j < cellsCol.length;j++){var cellVal = cellsCol[this._c_order?this._c_order[j]:j];var cind = r._childIndexes?r._childIndexes[j]:j;var exc = cellVal.getAttribute("type");if (r.childNodes[cind]){if (exc)r.childNodes[cind]._cellType=exc;r.childNodes[cind]._attrs=this._xml_attrs(cellVal)};if (!cellVal.getAttribute("xmlcontent")){if (cellVal.firstChild)cellVal=cellVal.firstChild.data;else
 cellVal=""};strAr.push(cellVal)};for (j < cellsCol.length;j < r.childNodes.length;j++)r.childNodes[j]._attrs={};if (r.parentNode&&r.parentNode.tagName == "row")r._attrs["parent"]=r.parentNode.getAttribute("idd");this._fillRow(r, strAr);return r},
 _get_xml_data:function(data, ind){data=data.firstChild;while (true){if (!data)return "";if (data.tagName == "cell")ind--;if (ind < 0)break;data=data.nextSibling};return (data.firstChild ? data.firstChild.data : "")},

 _fillRow:function(r, text){if (this.editor)this.editStop();for (var i = 0;i < r.childNodes.length;i++){if ((i < text.length)||(this.defVal[i])){var ii=r.childNodes[i]._cellIndex;var val = text[ii];var aeditor = this.cells4(r.childNodes[i]);if ((this.defVal[ii])&&((val == "")||( typeof (val) == "undefined")))
 val=this.defVal[ii];if (aeditor)aeditor.setValue(val)
 }else {r.childNodes[i].innerHTML="&nbsp;";r.childNodes[i]._clearCell=true}};return r},
 
 _postRowProcessing:function(r,donly){if (r._attrs["class"])r._css=r.className=r._attrs["class"];if (r._attrs.locked)r._locked=true;if (r._attrs.bgColor)r.bgColor=r._attrs.bgColor;var cor=0;for (var i = 0;i < r.childNodes.length;i++){var c=r.childNodes[i];var ii=c._cellIndex;var s = c._attrs.style||r._attrs.style;if (s)c.style.cssText+=";"+s;if (c._attrs["class"])c.className=c._attrs["class"];s=c._attrs.align||this.cellAlign[ii];if (s)c.align=s;c.vAlign=c._attrs.valign||this.cellVAlign[ii];var color = c._attrs.bgColor||this.columnColor[ii];if (color)c.bgColor=color;if (c._attrs["colspan"] && !donly){this.setColspan(r.idd, i+cor, c._attrs["colspan"]);cor+=(c._attrs["colspan"]-1)};if (this._hrrar&&this._hrrar[ii]&&!donly)c.style.display="none"};this.callEvent("onRowCreated", [
 r.idd,
 r,
 null
 ])},
 
 load:function(url, call, type){this.callEvent("onXLS", [this]);if (arguments.length == 2 && typeof call != "function"){type=call;call=null};type=type||"xml";if (!this.xmlFileUrl)this.xmlFileUrl=url;this._data_type=type;this.xmlLoader.onloadAction=function(that, b, c, d, xml){xml=that["_process_"+type](xml);if (!that._contextCallTimer)that.callEvent("onXLE", [that,0,0,xml]);if (call){call();call=null}};this.xmlLoader.loadXML(url)},

 loadXMLString:function(str, afterCall){var t = new dtmlXMLLoaderObject(function(){});t.loadXMLString(str);this.parse(t, afterCall, "xml")
 },

 loadXML:function(url, afterCall){this.load(url, afterCall, "xml")
 },
 
 parse:function(data, call, type){if (arguments.length == 2 && typeof call != "function"){type=call;call=null};type=type||"xml";this._data_type=type;data=this["_process_"+type](data);if (!this._contextCallTimer)this.callEvent("onXLE", [this,0,0,data]);if (call)call()},
 
 xml:{top: "rows",
 row: "./row",
 cell: "./cell",
 s_row: "row",
 s_cell: "cell",
 row_attrs: [],
 cell_attrs: []
 },
 
 csv:{row: "\n",
 cell: ","
 },
 
 _xml_attrs:function(node){var data = {};if (node.attributes.length){for (var i = 0;i < node.attributes.length;i++)data[node.attributes[i].name]=node.attributes[i].value};return data},

 _process_xml:function(xml){if (!xml.doXPath){var t = new dtmlXMLLoaderObject(function(){});if (typeof xml == "string")t.loadXMLString(xml);else {if (xml.responseXML)t.xmlDoc=xml;else
 t.xmlDoc={};t.xmlDoc.responseXML=xml};xml=t};if (this._refresh_mode)return this._refreshFromXML(xml);this._parsing=true;var top = xml.getXMLTopNode(this.xml.top)
 if (top.tagName.toLowerCase()!=this.xml.top) return;this._parseHead(top);var rows = xml.doXPath(this.xml.row, top)
 var cr = parseInt(xml.doXPath("//"+this.xml.top)[0].getAttribute("pos")||0);var total = parseInt(xml.doXPath("//"+this.xml.top)[0].getAttribute("total_count")||0);if (total&&!this.rowsBuffer[total-1])this.rowsBuffer[total-1]=null;if (this.isTreeGrid())
 return this._process_tree_xml(xml);for (var i = 0;i < rows.length;i++){if (this.rowsBuffer[i+cr])continue;var id = rows[i].getAttribute("id")||(i+cr+1);this.rowsBuffer[i+cr]={idd: id,
 data: rows[i],
 _parser: this._process_xml_row,
 _locator: this._get_xml_data
 };this.rowsAr[id]=rows[i]};this.render_dataset();this._parsing=false;return xml.xmlDoc.responseXML?xml.xmlDoc.responseXML:xml.xmlDoc},


 _process_jsarray:function(data){this._parsing=true;if (data&&data.xmlDoc)eval("data="+data.xmlDoc.responseText+";");for (var i = 0;i < data.length;i++){var id = i+1;this.rowsBuffer.push({idd: id,
 data: data[i],
 _parser: this._process_jsarray_row,
 _locator: this._get_jsarray_data
 });this.rowsAr[id]=data[i]};this.render_dataset();this._parsing=false},
 
 _process_csv:function(data){this._parsing=true;if (data.xmlDoc)data=data.xmlDoc.responseText;data=data.replace(/\r/g,"");data=data.split(this.csv.row);if (this._csvHdr){this.clearAll();var thead=data.splice(0,1)[0].split(this.csv.cell);if (!this._csvAID)thead.splice(0,1);this.setHeader(thead.join(this.delim));this.init()};for (var i = 0;i < data.length;i++){if (!data[i] && i==data.length-1)continue;if (this._csvAID){var id = i+1;this.rowsBuffer.push({idd: id,
 data: data[i],
 _parser: this._process_csv_row,
 _locator: this._get_csv_data
 })}else {var temp = data[i].split(this.csv.cell);var id = temp.splice(0,1)[0];this.rowsBuffer.push({idd: id,
 data: temp,
 _parser: this._process_jsarray_row,
 _locator: this._get_jsarray_data
 })};this.rowsAr[id]=data[i]};this.render_dataset();this._parsing=false},
 
 _process_json:function(data){this._parsing=true;if (data&&data.xmlDoc)eval("data="+data.xmlDoc.responseText+";");for (var i = 0;i < data.rows.length;i++){var id = data.rows[i].id;this.rowsBuffer.push({idd: id,
 data: data.rows[i],
 _parser: this._process_json_row,
 _locator: this._get_json_data
 });this.rowsAr[id]=data[i]};this.render_dataset();this._parsing=false},

 render_dataset:function(min, max){if (this._srnd){if (this._fillers)return this._update_srnd_view();max=Math.min((this._get_view_size()+(this._srnd_pr||0)), this.rowsBuffer.length)};if (this.pagingOn){min=Math.max((min||0),(this.currentPage-1)*this.rowsBufferOutSize);max=Math.min(this.currentPage*this.rowsBufferOutSize, this.rowsBuffer.length)
 }else {min=min||0;max=max||this.rowsBuffer.length};for (var i = min;i < max;i++){var r = this.render_row(i)
 
 if (r == -1){if (this.xmlFileUrl){if (this.callEvent("onDynXLS",[i,(this._dpref?this._dpref:(max-i))]))
 this.load(this.xmlFileUrl+getUrlSymbol(this.xmlFileUrl)+"posStart="+i+"&count="+(this._dpref?this._dpref:(max-i)), this._data_type)};max=i;break};if (!r.parentNode||!r.parentNode.tagName){this._insertRowAt(r, i);if (r._attrs["selected"] || r._attrs["select"]){this.selectRow(r,r._attrs["call"]?true:false,true);r._attrs["selected"]=r._attrs["select"]=null}};if (this._ads_count && i-min==this._ads_count){var that=this;this._context_parsing=this._context_parsing||this._parsing;return this._contextCallTimer=window.setTimeout(function(){that._contextCallTimer=null;that.render_dataset(i,max);if (!that._contextCallTimer){if(that._context_parsing)that.callEvent("onXLE",[])
 else 
 that._fixAlterCss();that.callEvent("onDistributedEnd",[]);that._context_parsing=false}},this._ads_time)
 }};if (this._srnd&&!this._fillers)this._fillers=[this._add_filler(max, this.rowsBuffer.length-max)];this.setSizes()},
 
 render_row:function(ind){if (!this.rowsBuffer[ind])return -1;if (this.rowsBuffer[ind]._parser){var r = this.rowsBuffer[ind];if (this.rowsAr[r.idd] && this.rowsAr[r.idd].tagName=="TR")return this.rowsBuffer[ind]=this.rowsAr[r.idd];var row = this._prepareRow(r.idd);this.rowsBuffer[ind]=row;this.rowsAr[r.idd]=row;r._parser.call(this, row, r.data);this._postRowProcessing(row);return row};return this.rowsBuffer[ind]},
 
 
 _get_cell_value:function(row, ind, method){if (row._locator){if (this._c_order)ind=this._c_order[ind];return row._locator.call(this, row.data, ind)};return this.cells3(row, ind)[method ? method : "getValue"]()},

 
 sortRows:function(col, type, order){order=(order||"asc").toLowerCase();type=(type||this.fldSort[col]);col=col||0;if (this.isTreeGrid())
 this.sortTreeRows(col, type, order);else{var arrTS = {};var atype = this.cellType[col];var amet = "getValue";if (atype == "link")amet="getContent";if (atype == "dhxCalendar"||atype == "dhxCalendarA")amet="getDate";for (var i = 0;i < this.rowsBuffer.length;i++)arrTS[this.rowsBuffer[i].idd]=this._get_cell_value(this.rowsBuffer[i], col, amet);this._sortRows(col, type, order, arrTS)};this.callEvent("onAfterSorting", [col,type,order])},
 
 _sortCore:function(col, type, order, arrTS, s){var sort = "sort";if (this._sst){s["stablesort"]=this.rowsCol.stablesort;sort="stablesort"};if (type.length > 4)type=window[type];if (type == 'cus'){var cstr=this._customSorts[col];s[sort](function(a, b){return cstr(arrTS[a.idd], arrTS[b.idd], order, a.idd, b.idd)})}else if (typeof (type)== 'function'){s[sort](function(a, b){return type(arrTS[a.idd], arrTS[b.idd], order, a.idd, b.idd)})}else


 if (type == 'str'){s[sort](function(a, b){if (order == "asc")return arrTS[a.idd] > arrTS[b.idd] ? 1 : -1
 else
 return arrTS[a.idd] < arrTS[b.idd] ? 1 : -1
 })}else if (type == 'int'){s[sort](function(a, b){var aVal = parseFloat(arrTS[a.idd]);aVal=isNaN(aVal) ? -99999999999999 : aVal;var bVal = parseFloat(arrTS[b.idd]);bVal=isNaN(bVal) ? -99999999999999 : bVal;if (order == "asc")return aVal-bVal;else
 return bVal-aVal})}else if (type == 'date'){s[sort](function(a, b){var aVal = Date.parse(arrTS[a.idd])||(Date.parse("01/01/1900"));var bVal = Date.parse(arrTS[b.idd])||(Date.parse("01/01/1900"));if (order == "asc")return aVal-bVal
 else
 return bVal-aVal
 })}},
 
 _sortRows:function(col, type, order, arrTS){this._sortCore(col, type, order, arrTS, this.rowsBuffer);this._reset_view();this.callEvent("onGridReconstructed", [])},

 _reset_view:function(skip){if (!this.obj.rows[0])return;var tb = this.obj.rows[0].parentNode;var tr = tb.removeChild(tb.childNodes[0], true)
 if (_isKHTML)for (var i = tb.parentNode.childNodes.length-1;i >= 0;i--){if (tb.parentNode.childNodes[i].tagName=="TR")tb.parentNode.removeChild(tb.parentNode.childNodes[i],true)}else if (_isIE)for (var i = tb.childNodes.length-1;i >= 0;i--)tb.childNodes[i].removeNode(true);else
 tb.innerHTML="";tb.appendChild(tr)
 this.rowsCol=dhtmlxArray();if (this._sst)this.enableStableSorting(true);this._fillers=this.undefined;if (!skip){if (_isIE && this._srnd){this.render_dataset()}else
 this.render_dataset()}},
 
 
 deleteRow:function(row_id, node){if (!node)node=this.getRowById(row_id)
 
 if (!node)return;this.editStop();if (this.callEvent("onBeforeRowDeleted", [row_id])== false)
 return false;var pid=0;if (this.cellType._dhx_find("tree")!= -1 && !this._realfake){pid=this._h2.get[row_id].parent.id;this._removeTrGrRow(node)}else {if (node.parentNode)node.parentNode.removeChild(node);var ind = this.rowsCol._dhx_find(node);if (ind != -1)this.rowsCol._dhx_removeAt(ind);for (var i = 0;i < this.rowsBuffer.length;i++)if (this.rowsBuffer[i]&&this.rowsBuffer[i].idd == row_id){this.rowsBuffer._dhx_removeAt(i);ind=i;break}};this.rowsAr[row_id]=null;for (var i = 0;i < this.selectedRows.length;i++)if (this.selectedRows[i].idd == row_id)this.selectedRows._dhx_removeAt(i);if (this._srnd){for (var i = 0;i < this._fillers.length;i++){var f = this._fillers[i]
 if (!f)continue;if (f[0] >= ind)f[0]=f[0]-1;else if (f[1] >= ind)f[1]=f[1]-1};this._update_srnd_view()};if (this.pagingOn)this.changePage();if (!this._realfake)this.callEvent("onAfterRowDeleted", [row_id,pid]);this.callEvent("onGridReconstructed", []);if (this._ahgr)this.setSizes();return true},
 
 _addRow:function(new_id, text, ind){if (ind == -1|| typeof ind == "undefined")ind=this.rowsBuffer.length;if (typeof text == "string")text=text.split(this.delim);var row = this._prepareRow(new_id);row._attrs={};for (var j = 0;j < row.childNodes.length;j++)row.childNodes[j]._attrs={};this.rowsAr[row.idd]=row;if (this._h2)this._h2.get[row.idd].buff=row;this._fillRow(row, text)
 this._postRowProcessing(row)
 if (this._skipInsert){this._skipInsert=false;return this.rowsAr[row.idd]=row};if (this.pagingOn){this.rowsBuffer._dhx_insertAt(ind,row);this.rowsAr[row.idd]=row;return row};if (this._fillers){this.rowsCol._dhx_insertAt(ind, null);this.rowsBuffer._dhx_insertAt(ind,row);if (this._fake)this._fake.rowsCol._dhx_insertAt(ind, null);this.rowsAr[row.idd]=row;var found = false;for (var i = 0;i < this._fillers.length;i++){var f = this._fillers[i];if (f&&f[0] <= ind&&(f[0]+f[1])>= ind){f[1]=f[1]+1;f[2].firstChild.style.height=parseInt(f[2].firstChild.style.height)+this._srdh+"px";found=true;if (this._fake)this._fake._fillers[i][1]++};if (f&&f[0] > ind){f[0]=f[0]+1
 if (this._fake)this._fake._fillers[i][0]++}};if (!found)this._fillers.push(this._add_filler(ind, 1, (ind == 0 ? {parentNode: this.obj.rows[0].parentNode,
 nextSibling: (this.rowsCol[1])
 }: this.rowsCol[ind-1])));return row};this.rowsBuffer._dhx_insertAt(ind,row);return this._insertRowAt(row, ind)},
 
 
 addRow:function(new_id, text, ind){var r = this._addRow(new_id, text, ind);if (!this.dragContext)this.callEvent("onRowAdded", [new_id]);if (this.pagingOn)this.changePage(this.currentPage)
 
 if (this._srnd)this._update_srnd_view();r._added=true;if (this._ahgr)this.setSizes();this.callEvent("onGridReconstructed", []);return r},
 
 _insertRowAt:function(r, ind, skip){this.rowsAr[r.idd]=r;if (this._skipInsert){this._skipInsert=false;return r};if ((ind < 0)||((!ind)&&(parseInt(ind) !== 0)))
 ind=this.rowsCol.length;else {if (ind > this.rowsCol.length)ind=this.rowsCol.length};if (this._cssEven){if ((this._cssSP ? this.getLevel(r.idd): ind)%2 == 1)
 r.className+=" "+this._cssUnEven+(this._cssSU ? (this._cssUnEven+"_"+this.getLevel(r.idd)) : "");else
 r.className+=" "+this._cssEven+(this._cssSU ? (" "+this._cssEven+"_"+this.getLevel(r.idd)) : "")};if (!skip)if ((ind == (this.obj.rows.length-1))||(!this.rowsCol[ind]))
 if (_isKHTML)this.obj.appendChild(r);else {this.obj.firstChild.appendChild(r)}else {this.rowsCol[ind].parentNode.insertBefore(r, this.rowsCol[ind])};this.rowsCol._dhx_insertAt(ind, r);return r},
 
 getRowById:function(id){var row = this.rowsAr[id];if (row){if (row.tagName != "TR"){for (var i = 0;i < this.rowsBuffer.length;i++)if (this.rowsBuffer[i] && this.rowsBuffer[i].idd == id)return this.render_row(i);if (this._h2)return this.render_row(null,row.idd)};return row};return null},
 

 cellById:function(row_id, col){return this.cells(row_id, col)},

 cells:function(row_id, col){if (arguments.length == 0)return this.cells4(this.cell);else
 var c = this.getRowById(row_id);var cell = (c._childIndexes ? c.childNodes[c._childIndexes[col]] : c.childNodes[col]);return this.cells4(cell)},
 
 cellByIndex:function(row_index, col){return this.cells2(row_index, col)},
 
 cells2:function(row_index, col){var c = this.render_row(row_index);var cell = (c._childIndexes ? c.childNodes[c._childIndexes[col]] : c.childNodes[col]);return this.cells4(cell)},
 
 cells3:function(row, col){var cell = (row._childIndexes ? row.childNodes[row._childIndexes[col]] : row.childNodes[col]);return this.cells4(cell)},
 
 cells4:function(cell){var type = window["eXcell_"+(cell._cellType||this.cellType[cell._cellIndex])];if (type)return new type(cell)}, 
 cells5:function(cell, type){var type = type||(cell._cellType||this.cellType[cell._cellIndex]);if (!this._ecache[type]){if (!window["eXcell_"+type])var tex = eXcell_ro;else
 var tex = window["eXcell_"+type];this._ecache[type]=new tex(cell)};this._ecache[type].cell=cell;return this._ecache[type]},
 dma:function(mode){if (!this._ecache)this._ecache={};if (mode&&!this._dma){this._dma=this.cells4;this.cells4=this.cells5}else if (!mode&&this._dma){this.cells4=this._dma;this._dma=null}},
 
 
 getRowsNum:function(){return this.rowsBuffer.length},
 
 
 
 enableEditTabOnly:function(mode){if (arguments.length > 0)this.smartTabOrder=convertStringToBoolean(mode);else
 this.smartTabOrder=true},
 
 setExternalTabOrder:function(start, end){var grid = this;this.tabStart=( typeof (start) == "object") ? start : document.getElementById(start);this.tabStart.onkeydown=function(e){var ev = (e||window.event);if (ev.keyCode == 9){ev.cancelBubble=true;grid.selectCell(0, 0, 0, 0, 1);if (grid.smartTabOrder && grid.cells2(0, 0).isDisabled()){grid._key_events["k9_0_0"].call(grid)};this.blur();return false}};if(_isOpera)this.tabStart.onkeypress = this.tabStart.onkeydown;this.tabEnd=( typeof (end) == "object") ? end : document.getElementById(end);this.tabEnd.onkeydown=this.tabEnd.onkeypress=function(e){var ev = (e||window.event);if ((ev.keyCode == 9)&&ev.shiftKey){ev.cancelBubble=true;grid.selectCell((grid.getRowsNum()-1), (grid.getColumnCount()-1), 0, 0, 1);if (grid.smartTabOrder && grid.cells2((grid.getRowsNum()-1), (grid.getColumnCount()-1)).isDisabled()){grid._key_events["k9_0_1"].call(grid)};this.blur();return false}};if(_isOpera)this.tabEnd.onkeypress = this.tabEnd.onkeydown},
 
 uid:function(){if (!this._ui_seed)this._ui_seed=(new Date()).valueOf();return this._ui_seed++},
 
 clearAndLoad:function(){var t=this._pgn_skin;this._pgn_skin=null;this.clearAll();this._pgn_skin=t;this.load.apply(this,arguments)},
 
 getStateOfView:function(){if (this.pagingOn){var start = (this.currentPage-1)*this.rowsBufferOutSize;return [this.currentPage, start, Math.min(start+this.rowsBufferOutSize,this.rowsBuffer.length), this.rowsBuffer.length ]};return [
 Math.floor(this.objBox.scrollTop/this._srdh),
 Math.ceil(parseInt(this.objBox.offsetHeight)/this._srdh),
 this.rowsBuffer.length
 ]}};(function(){function direct_set(name,value){this[name]=value};function direct_call(name,value){this[name].call(this,value)};function joined_call(name,value){this[name].call(this,value.join(this.delim))};function set_options(name,value){for (var i=0;i < value.length;i++)if (typeof value[i] == "object"){var combo = this.getCombo(i);for (var key in value[i])combo.put(key, value[i][key])}};function header_set(name,value,obj){var rows = 1;var header = [];function add(i,j,value){if (!header[j])header[j]=[];if (typeof value == "object")value.toString=function(){return this.text};header[j][i]=value};for (var i=0;i<value.length;i++){if (typeof(value[i])=="object" && value[i].length){for (var j=0;j < value[i].length;j++)add(i,j,value[i][j])}else
 add(i,0,value[i])};for (var i=0;i<header.length;i++)for (var j=0;j<header[0].length;j++){var h=header[i][j];header[i][j]=(h||"").toString()||"&nbsp;";if (h&&h.colspan)for (var k=1;k < h.colspan;k++)add(j+k,i,"#cspan");if (h&&h.rowspan)for (var k=1;k < h.rowspan;k++)add(j,i+k,"#rspan")};this.setHeader(header[0]);for (var i=1;i < header.length;i++)this.attachHeader(header[i])};var columns_map=[
 {name:"label", def:"&nbsp;", operation:"setHeader", type:header_set },
 {name:"id", def:"", operation:"columnIds", type:direct_set },
 {name:"width", def:"*", operation:"setInitWidths", type:joined_call },
 {name:"align", def:"left", operation:"cellAlign", type:direct_set },
 {name:"valign", def:"top", operation:"cellVAlign", type:direct_set },
 {name:"sort", def:"na", operation:"fldSort", type:direct_set },
 {name:"type", def:"ro", operation:"setColTypes", type:joined_call },
 {name:"options",def:"", operation:"", type:set_options }];dhtmlx.extend_api("dhtmlXGridObject",{_init:function(obj){return [obj.parent]},
 image_path:"setImagePath",
 columns:"columns",
 rows:"rows",
 headers:"headers",
 skin:"setSkin",
 smart_rendering:"enableSmartRendering",
 css:"enableAlterCss",
 auto_height:"enableAutoHeight",
 save_hidden:"enableAutoHiddenColumnsSaving",
 save_cookie:"enableAutoSaving",
 save_size:"enableAutoSizeSaving",
 auto_width:"enableAutoWidth",
 block_selection:"enableBlockSelection",
 csv_id:"enableCSVAutoID",
 csv_header:"enableCSVHeader",
 cell_ids:"enableCellIds",
 colspan:"enableColSpan",
 column_move:"enableColumnMove",
 context_menu:"enableContextMenu",
 distributed:"enableDistributedParsing",
 drag:"enableDragAndDrop",
 drag_order:"enableDragOrder",
 tabulation:"enableEditTabOnly",
 header_images:"enableHeaderImages",
 header_menu:"enableHeaderMenu",
 keymap:"enableKeyboardSupport",
 mouse_navigation:"enableLightMouseNavigation",
 markers:"enableMarkedCells",
 math_editing:"enableMathEditing",
 math_serialization:"enableMathSerialization",
 drag_copy:"enableMercyDrag",
 multiline:"enableMultiline",
 multiselect:"enableMultiselect",
 save_column_order:"enableOrderSaving",
 hover:"enableRowsHover",
 rowspan:"enableRowspan",
 smart:"enableSmartRendering",
 save_sorting:"enableSortingSaving",
 stable_sorting:"enableStableSorting",
 undo:"enableUndoRedo",
 csv_cell:"setCSVDelimiter",
 date_format:"setDateFormat",
 drag_behavior:"setDragBehavior",
 editable:"setEditable",
 without_header:"setNoHeader",
 submit_changed:"submitOnlyChanged",
 submit_serialization:"submitSerialization",
 submit_selected:"submitOnlySelected",
 submit_id:"submitOnlyRowID", 
 xml:"load"
 },{columns:function(obj){for (var j=0;j<columns_map.length;j++){var settings = [];for (var i=0;i<obj.length;i++)settings[i]=obj[i][columns_map[j].name]||columns_map[j].def;var type=columns_map[j].type||direct_call;type.call(this,columns_map[j].operation,settings,obj)};this.init()},
 rows:function(obj){},
 headers:function(obj){for (var i=0;i < obj.length;i++)this.attachHeader(obj[i])}})})();//(c)dhtmlx ltd. www.dhtmlx.com
//v.2.5 build 090904

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
To use this component please contact sales@dhtmlx.com to obtain license
*/