const LazyLoader = require('./LazyLoader');
const _ = require('lodash');
const mermaidAPIx = require('mermaid');

var lazyLoad = new LazyLoader(window.document);

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
        debugger;
        if (this.apply()) {
            this.loadGraph();
        }
    }

    apply() {
        return $('.CodeMirror-sizer').length > 0;
    }

    renderToElement(id, markdownContent, $toEle) {
        mermaidAPIx.render(id, markdownContent, function (svgCode) {
            $toEle.append(svgCode);
        });
    }

    getMarkupContent(ele) {
        let $el = $(ele).clone();
        $el.find('.CodeMirror-linenumber').remove();
        let element = $el[0];
        element.innerHTML = element.innerHTML.replace(/<br\s*[\/]?>/gi, ';');
        return element.textContent.trim().replace(/    /g, ';');
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
                me.renderToElement('graph-' + index, content, $(ele));
            }
        });

    }

}

module.exports = MarkdownGraph;
