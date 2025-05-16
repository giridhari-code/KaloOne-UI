<?php
$words = $words ?? ['Default'];
$interval = $interval ?? 3000;
$wordsJS = json_encode($words);
$id = 'flip_' . uniqid();
$first = htmlspecialchars($words[0]);
?>

<div class="inline-block text-neutral-900 dark:text-white text-3xl font-bold relative h-10 overflow-hidden">
    <span
        id="<?= $id ?>"
        class="inline-block transition-all duration-500 ease-in-out transform origin-top animate-fade"
    >
        <?= $first ?>
    </span>
    <div id="<?= $id ?>-underline" class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 transform origin-left scale-x-0 transition-transform duration-300 ease-in-out"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const words = <?= $wordsJS ?>;
        const el = document.getElementById("<?= $id ?>");
        const underline = document.getElementById("<?= $id ?>-underline");
        let i = 0;

        setInterval(() => {
            underline.classList.remove("scale-x-100");
            underline.classList.add("scale-x-0");
            el.classList.add("animate-fade-out");
            el.classList.remove("animate-fade-in");

            setTimeout(() => {
                i = (i + 1) % words.length;
                el.textContent = words[i];
                el.classList.remove("animate-fade-out");
                el.classList.add("animate-fade-in");
                underline.classList.remove("scale-x-0");
                underline.classList.add("scale-x-100");
            }, 500); // CSS ट्रांज़िशन अवधि से मेल खाना चाहिए
        }, <?= $interval ?>);

        // प्रारंभिक एनीमेशन
        el.classList.add("animate-fade-in");
        underline.classList.add("scale-x-100");
    });
</script>

<style>
  @keyframes fade-in {
    0% { opacity: 0; transform: translateY(10px); filter: blur(4px); }
    100% { opacity: 1; transform: translateY(0); filter: blur(0); }
  }

  @keyframes fade-out {
    0% { opacity: 1; transform: translateY(0); filter: blur(0); }
    100% { opacity: 0; transform: translateY(-10px); filter: blur(4px); }
  }

  .animate-fade-in {
    animation: fade-in 0.5s ease-in-out forwards;
  }

  .animate-fade-out {
    animation: fade-out 0.5s ease-in-out forwards;
  }
</style>