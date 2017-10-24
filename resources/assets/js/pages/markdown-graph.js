const _ = require('lodash');
const mermaid = require('mermaid');

const support_graphs = [
    'graph TD',
    'graph LR',
    'sequenceDiagram'
];

class MarkdownGraph {

    renderOnElement(element) {
        let content = this.getMarkupContent(element);
        if (!this._isSupport(content)) {
            return;
        }
        let id = 'graph-' + Math.floor(Math.random() * 1000);
        let $toEle = $(element);
        if( $toEle.find('.chart').length == 0){
        	$toEle.append("<div class='chart' />")
        }
        mermaid.render(id, content, (svgCode) => {
            $toEle.append(svgCode);
        }, $('.chart', $toEle)[0]);
    }

    getMarkupContent(ele) {
        return $(ele).find('.CodeMirror-code .CodeMirror-line')
            .text().trim()
            .replace('xxxxxxxxxx','').trim()
            .replace(/\s\s+/g, ';');
    }

    _isSupport(markdownContent) {
        return _.some(support_graphs, function (g) {
            return markdownContent.startsWith(g);
        });
    }

    pageShow() {
        let $graphsCode = $('.CodeMirror-sizer');
        $graphsCode.each((index, ele) => {
            this.renderOnElement(ele);
        });
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
