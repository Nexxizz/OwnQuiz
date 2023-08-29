function start() {
        let elem = document.getElementById("myBar");
        let width = 10;
        let id =  setInterval(frame, 600);

        function frame() {
            if (elem != null) {
                console.log(elem.getAttribute("data-percent"));
                if (parseInt(elem.getAttribute("data-percent")) >= 100) {
                    clearInterval(id);
                    document.getElementsByTagName('form')[0].submit();
                    elem.setAttribute("data-percent", '0');
                } else {
                    width++;
                    console.log('width: ' + width);
                    elem.style.width = parseInt(elem.getAttribute("data-percent")) + '%';
                    elem.setAttribute("data-percent", parseInt(elem.getAttribute("data-percent")) + 10);
                }
            }
        }
}
