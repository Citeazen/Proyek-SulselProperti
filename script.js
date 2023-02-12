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

// CKEDITOR
function ckedit_desc() {
    CKEDITOR.replace("descriptions", {
        filebrowserUploadUrl: "uploadimg.php",
        filebrowserUploadMethod: "form",
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
        ],

        removePlugins:
            "about,basicstyles,enterkey,entities,floatingspace,format,horizontalrule,htmlwriter,indent,indentblock,indentlist,justify,list,liststyle,magicline,mathjax,pagebreak,pastefromword,pastetext,preview,print,removeformat,resize,save,scayt,showblocks,showborders,smiley,sourcearea,specialchar,stylescombo,tab,templates,wsc",

        filebrowserUploadUrl: "uploadimg.php",
        filebrowserUploadMethod: "form",
    });
}
