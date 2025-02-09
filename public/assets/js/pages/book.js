const input = document.getElementById("text");
const copyButton = document.getElementById("copy");

const copyText = (e) => {
    // window.getSelection().selectAllChildren(textElement);
    input.select(); //select input value
    document.execCommand("copy");
    e.currentTarget.setAttribute("tooltip", "Copied!");
};

const resetTooltip = (e) => {
    e.currentTarget.setAttribute("tooltip", "Copy to clipboard");
};

copyButton.addEventListener("click", (e) => copyText(e));
copyButton.addEventListener("mouseover", (e) => resetTooltip(e));


document.addEventListener('DOMContentLoaded', ()=>{
    const ratingBox = document.querySelector('.give-rating');
    const ratingInput = ratingBox.querySelector('#rating');

    const stars = ratingBox.querySelectorAll('.star');

    stars.forEach((star, index) => {
        star.addEventListener('click', function(){
            stars.forEach((s) => {
                s.classList.remove("text-warning");
            });
            stars.forEach((s, i) => {
                if(i <= index){
                    s.classList.add("text-warning");
                }
            });

            ratingInput.value = index + 1;
        });
    });

});
