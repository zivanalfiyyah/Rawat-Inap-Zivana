// Galaxy starfield generator ✨

const totalStars = 140;

for (let i = 0; i < totalStars; i++) {
    let star = document.createElement("div");
    star.className = "star";

    star.style.left = Math.random() * 100 + "vw";
    star.style.top = Math.random() * 100 + "vh";

    let size = Math.random() * 2 + 1;
    star.style.width = size + "px";
    star.style.height = size + "px";

    star.style.animationDuration = (Math.random() * 3 + 2) + "s";

    document.body.appendChild(star);
}
