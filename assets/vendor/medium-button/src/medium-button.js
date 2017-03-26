'use strict'
/**
 *   MediumButton  1.0 (24.02.2015)
 *   MIT (c) Patrick Stillhart
 */

function MediumButton(options) {
	if (options.label === undefined || !/\S{1}/.test(options.label) ||
		options.start === undefined || !/\S{1}/.test(options.start) ||
		options.end === undefined || !/\S{1}/.test(options.end)) {

		if (options.label === undefined || !/\S{1}/.test(options.label) ||
			options.action === undefined || !/\S{1}/.test(options.action)) {
			console.error('[Custom-Button] You need to specify "label", "start" and "end" OR "label" and "action"')
			return
		}
	}

	options.start = (options.start === undefined) ? '' : options.start
	options.end = (options.end === undefined) ? '' : options.end

	var self = this

	this.options = options
	this.button = document.createElement('button')
	this.button.className = 'medium-editor-action'
	this.button.innerHTML = options.label
	this.button.onclick = function() {

		// get current selectet text
		var html = getCurrentSelection()
		var sel = window.getSelection()
		var parent = sel.anchorNode.parentElement

		// modify content
		var mark = true
		if (options.start === undefined || html.indexOf(options.start) == -1 && html.indexOf(options.end) == -1) {

			if (options.action != undefined) html = options.action(html, true, parent)
			html = options.start + html + options.end

		} else { // clean old

			if (options.action != undefined) html = options.action(html, false, parent)
			html = String(html).split(options.start).join('')
			html = String(html).split(options.end).join('')

		}


		var range
		var fragment
			//Set new Content
		if (sel.getRangeAt && sel.rangeCount) {

			range = window.getSelection().getRangeAt(0)
			range.deleteContents()

			if (range.createContextualFragment) fragment = range.createContextualFragment(html)
			else {
				var div = document.createElement('div')

				div.innerHTML = html
				fragment = document.createDocumentFragment()
				while ((child = div.firstChild)) fragment.appendChild(child)

			}

			var firstInsertedNode = fragment.firstChild
			var lastInsertedNode = fragment.lastChild
			range.insertNode(fragment)

			if (firstInsertedNode) {
				range.setStartBefore(firstInsertedNode)
				range.setEndAfter(lastInsertedNode)
			}

			sel.removeAllRanges()
			sel.addRange(range)

		}

		self.base.checkContentChanged()

	}

}

MediumButton.prototype.getButton = function() {
	return this.button
}

MediumButton.prototype.checkState = function(node) {
	var html = getCurrentSelection()

	if (this.options.start != '' && html.indexOf(this.options.start) > -1 && html.indexOf(this.options.end) > -1) {
		this.button.classList.add('medium-editor-button-active')
	} else {
		this.button.classList.remove('medium-editor-button-active')
	}

}

function getCurrentSelection() {
	var html = ''
	var sel

	if (typeof window.getSelection != 'undefined') {
		sel = window.getSelection()
		if (sel.rangeCount) {
			var container = document.createElement('div')
			for (var i = 0, len = sel.rangeCount; i < len; ++i) {
				container.appendChild(sel.getRangeAt(i).cloneContents())
			}
			html = container.innerHTML
		}
	} else if (typeof document.selection != 'undefined') {
		if (document.selection.type == 'Text') {
			html = document.selection.createRange().htmlText
		}
	}

	return html

}

if (typeof exports !== 'undefined') {
  if (typeof module !== 'undefined' && module.exports) {
    exports = module.exports = MediumButton
  }
  exports.MediumButton = MediumButton
}