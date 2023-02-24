//
function toggleNavbar() {
    const navbar = document.querySelector(".navigation");
    //
    document.querySelector(".openbtn").onclick = () => {
        navbar.classList.toggle("active");
    };

    //
    const hamburgermenu = document.querySelector(".openbtn");

    document.addEventListener("click", function (e) {
        if (!hamburgermenu.contains(e.target) && !navbar.contains(e.target)) {
            navbar.classList.remove("active");
        }
    });
}

function setActiveNavbarMenu() {
    const currentLocation = location.pathname;
    const navigationLinks = document.querySelectorAll(".navigation a");

    for (const link of navigationLinks) {
        if (link.href.endsWith(currentLocation)) {
            link.classList.add("active");
        }
    }
}

function onScrollActive() {
    const sections = document.querySelectorAll("section");
    const navItems = document.querySelectorAll("nav ul.navigation li a");
    const navHeight = document.querySelector("nav").offsetHeight;

    window.addEventListener("scroll", () => {
        let current = "";
        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= sectionTop - navHeight && pageYOffset < sectionTop + sectionHeight - navHeight) {
                current = section.getAttribute("id");
            }
        });
        navItems.forEach((item) => {
            item.classList.remove("active");
            if (item.getAttribute("href").includes(current)) {
                item.classList.add("active");
            }
        });
    });
}

function blockImages(className) {
    var images = document.getElementsByClassName(className);

    for (var i = 0; i < images.length; i++) {
        images[i].addEventListener("contextmenu", function (event) {
            event.preventDefault();
        });

        images[i].addEventListener("dragstart", function (event) {
            event.preventDefault();
        });
    }
}

function addImageModal(img) {
    document.querySelectorAll(".product-imgs").forEach(function (img) {
        img.addEventListener("click", function () {
            var modal = document.createElement("div");
            modal.style.position = "fixed";
            modal.style.top = 0;
            modal.style.left = 0;
            modal.style.backgroundColor = "rgba(0,0,0,0.8)";
            modal.style.width = "100%";
            modal.style.height = "100%";
            modal.style.zIndex = "2000";
            modal.style.display = "flex";
            modal.style.alignItems = "center";

            var modalImg = document.createElement("img");
            modalImg.src = this.src;
            modalImg.style.margin = "auto";
            // modalImg.style.display = "block";
            modalImg.style.maxWidth = "90%";
            modalImg.style.maxHeight = "90%";
            modal.appendChild(modalImg);

            var modalClose = document.createElement("button");
            modalClose.style.position = "absolute";
            modalClose.style.top = "10px";
            modalClose.style.right = "10px";
            modalClose.innerHTML = "&times;";
            modalClose.style.fontSize = "4em";
            modalClose.style.backgroundColor = "transparent";
            modalClose.style.border = "none";
            modalClose.style.color = "white";
            modalClose.addEventListener("click", function () {
                modal.style.display = "none";
            });
            modal.appendChild(modalClose);

            document.body.appendChild(modal);
        });
        img.addEventListener("contextmenu", function (e) {
            e.preventDefault();
        });
        img.addEventListener("mousedown", function (e) {
            e.preventDefault();
        });
    });
}

// CKEDITOR
function ckedit_desc() {
    CKEDITOR.replace("descriptions", {
        // extraPlugins: 'imageuploader'
        filebrowserBrowseUrl: "ck-browse.php",
        filebrowserUploadUrl: "ck-uploadimg.php",
        // filebrowserImageUploadUrl: "uploadimg.php?type=image",
        // filebrowserImage_removeUnused: true,
        filebrowserUploadMethod: "form",

        //     on: {
        //     fileUploadRequest: function (evt) {
        //         evt.data.requestData.used_images = document.getElementById('used_images').value;
        //     }
        // }
    });
}

function ckedit_imgs() {
    CKEDITOR.replace("opt_imgs", {
        toolbar: [
            {
                name: "clipboard",
                items: ["Undo", "Redo"],
            },
            {
                name: "insert",
                items: ["Image"],
            },
            {
                name: "tools",
                items: ["Maximize"],
            },
            {
                name: "tools",
                items: ["Source"],
            },
        ],

        // removePlugins:
        //     "imgbrowse,about,basicstyles,enterkey,entities,floatingspace,format,horizontalrule,htmlwriter,indent,indentblock,indentlist,justify,list,liststyle,magicline,mathjax,pagebreak,pastefromword,pastetext,preview,print,removeformat,resize,save,scayt,showblocks,showborders,smiley,sourcearea,specialchar,stylescombo,tab,templates,wsc",

        // filebrowserBrowseUrl: '/assets/ckeditor/plugins/imgbrowse/imgbrowse.php',
        // extraPlugins: 'imageuploader'
        filebrowserBrowseUrl: "ck-browse.php",
        // extraPlugins: 'zsuploader',
        filebrowserUploadUrl: "ck-uploadimg.php",
        // filebrowserImageUploadUrl: "uploadimg.php?type=image",
        // filebrowserImage_removeUnused: true,
        filebrowserUploadMethod: "form",

        //    extraPlugins: 'zsuploader',
        //     on: {
        // fileUploadRequest: function (evt) {
        //     evt.data.requestData.used_images = document.getElementById('used_images').value;
        // }

        // }
    });
}
