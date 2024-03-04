function sendPath(obj) {
	var x = obj.contentWindow.postMessage({ "parentUrl": window.location.href }, "*")
}
