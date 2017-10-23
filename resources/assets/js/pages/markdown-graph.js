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
        mermaid.render(id, content, function (svgCode) {
            $toEle.append(svgCode);
        });
    }

    getMarkupContent(ele) {
        let $el = $(ele).clone();
        $el.find('.CodeMirror-linenumber').remove();
        return $el.text().trim()
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

    pageForm() {
        //implement if want to display on editor
    }

    pageCodeDialog(codeEditor) {
        let $graphsCode = $(codeEditor.$el).find('.CodeMirror-sizer');
        $graphsCode.find('svg').remove();
        this.renderOnElement($graphsCode[0]);
    }

}

module.exports = MarkdownGraph;
