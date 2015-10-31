"use strict";

function caret(text, insertionPoint, insertedText) {
	text = text.substring(0, insertionPoint) + "‸" + text.substring(insertionPoint);

	var padding = Math.max(0, insertionPoint - insertedText.length / 2 + 1 | 0);

	return text + "\n" + Array(padding + 1).join(" ") + insertedText;
}

module.exports = caret;
