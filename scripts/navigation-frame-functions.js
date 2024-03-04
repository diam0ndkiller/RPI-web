function receiveMessage(event) {
	if (event.data.FrameHeight != undefined) {
		document.getElementById("nav").height = event.data.FrameHeight
	}
}

function resizeIframe(obj) {
	var height = obj.contentWindow.postMessage("FrameHeight", "*");
	obj.contentWindow.postMessage({ "parentUrl": window.location.href }, "*")
}

window.addEventListener("message", receiveMessage, false);
