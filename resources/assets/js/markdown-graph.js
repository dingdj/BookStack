const _ = require('lodash');
const mermaid = require('mermaid');

const support_graphs = [
    'graph TD',
    'graph LR',
    'sequenceDiagram'
];

class MarkdownGraph {
    constructor() {
        window.addEventListener('load', this.init.bind(this));
    }

    init() {
        if (this.apply()) {
            this.loadGraph();
        }
    }

    apply() {
        return $('.CodeMirror-sizer, .CodeMirrorContainer').length > 0;
    }

    renderToElement(id, markdownContent, $toEle) {
        mermaid.render(id, markdownContent, function (svgCode) {
            $toEle.find('svg').remove();
            $toEle.append(svgCode);
        });
    }

    getMarkupContent(ele) {
        let $el = $(ele).clone();
        $el.find('.CodeMirror-linenumber', 'svg').remove();
        let element = $el[0];
        element.innerHTML = element.innerHTML.replace(/<br\s*[\/]?>/gi, ';');
        return element.textContent.trim()
            .replace('xxxxxxxxxx','').trim()
            .replace(/    /g, ';');
    }

    loadGraph() {
        let $graphs = $('.CodeMirror-sizer');
        var me = this;
        $graphs.each(function (index, ele) {
            let content = me.getMarkupContent(ele);
            let is_graph_render_support = _.some(support_graphs, function (g) {
                return content.startsWith(g);
            });

            if (is_graph_render_support) {
                me.renderToElement('graph-' + index +  '-' + Math.floor(Math.random() * 1000), content, $(ele));
            }
        });

    }

}

module.exports = MarkdownGraph;
