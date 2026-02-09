<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UTBK Slime Pet - Alpine.js</title>

  <script src="https://cdn.tailwindcss.com"></script>
  
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <link rel="stylesheet" href="{{ asset('css/pet.css') }}">
</head>

<body class="min-h-screen flex items-center justify-center bg-slate-100">

  <div 
    x-data="{ 
        isClicked: false,
        trigger() {
            this.isClicked = true;
            // Reset state setelah durasi animasi (600ms)
            setTimeout(() => this.isClicked = false, 600);
        }
    }"
    class="slime"
    :class="{ 'animate-bounce-slime': isClicked }"
    @click="trigger"
  >
    <object
      data="{{ asset('img/pet(tanpa_animasi).svg') }}"
      type="image/svg+xml"
      style="width:200px;"
      class="pointer-events-none select-none"
    ></object>
  </div>

</body>
</html>