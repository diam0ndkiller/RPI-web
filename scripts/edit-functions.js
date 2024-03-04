loc = window.location.href;

function openEdit() {
	window.location.href = loc.replace("details.php", "edit.php")
}

function openDetails() {
	window.location.href = loc.replace("edit.php", "details.php")
}

function openNewEdit() {
	window.location.href = "./edit.php?new=1&theme=" + theme
}

function openOverview() {
	window.location.href = "./index.php?theme=" + theme
}
