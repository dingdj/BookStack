"use strict";

const _ = require('lodash');
const mermaid = require('mermaid');

const support_graphs = [
    'graph TD',
    'graph LR',
    'sequenceDiagram',
    'gantt'
];

class MarkdownGraph {

    renderOnElement(element) {
        let content = this.getMarkupContent(element);
        if (!this._isSupport(content)) {
            return;
        }
        let id = 'graph-' + Math.floor(Math.random() * 1000);
        let $toEle = $(element);
        if ($toEle.find('.graph-placeholder').length == 0) {
            $toEle.append("<div class='graph-placeholder' />");
        }
        mermaid.render(id, content, (svgCode) => {
            $toEle.append(svgCode);
        }, $('.graph-placeholder', $toEle)[0]);
    }

    getMarkupContent(ele) {
        let $codeLine = $(ele).find('.CodeMirror-code .CodeMirror-linenumber');
        $codeLine.hide();
        let code = ele.innerText.trim();
        $codeLine.show();
        return code;
    }

    _isSupport(markdownContent) {
        return support_graphs.some((g) => markdownContent.startsWith(g));
    }

    pageShow() {
        let $graphsCode = $('.CodeMirror-sizer');
        $graphsCode.each((index, ele) => this.renderOnElement(ele));
    }

    pageCodeDialog(codeEditor) {
        $(codeEditor.$el.querySelector('.CodeMirror')).off('keyup').on('keyup', _.debounce((e) => {
            let $graphsCode = $(e.currentTarget).find('.CodeMirror-sizer');
            $graphsCode.find('svg').remove();
            this.renderOnElement($graphsCode[0]);
        }, 250)).keyup();
    }

}

module.exports = MarkdownGraph;

