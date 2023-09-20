
<script src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/b_files/b_files/alpine.js"></script>
<style type="text/css">@import url(//fonts.googleapis.com/css?family=Open+Sans:200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic,200,300,400,500,600,700,800);</style>

<body x-data="build()" class="pt-12 md:pt-20 bg-gray-900" :class="{ &#39; overflow-y-hidden&#39;: openBuild, &#39;overflow-y-hidden &#39;: openCart,  &#39;overflow-y-hidden&#39;: showContactOverlay }" x-init="() =&gt; {
    setFrequencyFromCart()
    postcodeChecked = &#39;&#39; !== &#39;&#39; || deliverableTo;
    postcode = &#39;&#39;;
    setPrices({&quot;price&quot;:49.9});
  }" style="zoom: 1;" cz-shortcut-listen="true">
   <div class="transition duration-300 bg-gray-100 flex flex-col min-h-full benefit-raw-diet" :class="{ &#39;opacity-25&#39;: openCart }">
<div class="transition-colors duration-200 bg-white border-b border-gray-400" }="" @scroll.window="atTop = (window.pageYOffset &gt; 40) ? false : true">

    <div class="w-full bg-gray-100 py-16 md:py-20"><div class="container mx-auto px-3 md:px-10"><div class="flex flex-col mx-auto items-center"><div class="flex flex-col"><h2 class="text-3xl lg:text-4xl text-black inline-block font-display text-center px-5 md:px-0">Benefits of a Raw Diet</h2><div class="border-b-2 border-butchers-red-800 mt-2 w-1/2 md:w-2/3 mx-auto"></div></div><!-- <p class="text-base md:text-xl lg:px-20 xl:px-32 font-display text-gray-800 text-center mt-8">The benefits of raw are easy to see, inside and out. With changes like these you’ll have fewer trips to the vet saving you money.</p> --></div><div class="flex items-center flex-col lg:flex-row mt-12 xl:mt-20 text-gray-800"><div class="order-2 lg:order-1 w-full lg:w-1/2 xl:w-1/2 pr-0 xl:pr-16">

      <div class="flex flex-col items-center w-full lg:w-3/4 mx-auto">

        <div x-show="keyBenefit === 1" class="flex flex-col items-center text-center justify-center mt-8 lg:mt-0"><h4 class="text-2xl md:text-3xl lg:text-3xl font-display leading-none">Better weight control</h4><p class="text-gray-600 text-sm md:text-base font-light mt-3">Quality animal proteins, healthy fats, vegetables containing vitamins  and phytonutrients are what your dog needs to stay lean and healthy.  Processed diets are heavy in carbohydrates and synthetic nutrients and light on quality protein. Just look what happens to humans who eat a high carbohydrate diet.</p></div>
        <div x-show="keyBenefit === 2" class="flex flex-col items-center text-center justify-center mt-8 lg:mt-0" style="display: none;"><h4 class="text-2xl md:text-3xl lg:text-3xl font-display leading-none">Calmer</h4><p class="text-gray-600 text-sm md:text-base font-light mt-3">The gut-brain axis links the gut microbiome with brain function. By eliminating synthetic vitamins, minerals and preservatives and improving gut health, you can positively affect your dog's behaviour.</p></div>
        <div x-show="keyBenefit === 3" class="flex flex-col items-center text-center justify-center mt-8 lg:mt-0" style="display: none;"><h4 class="text-2xl md:text-3xl lg:text-3xl font-display leading-none">Improved digestion</h4><p class="text-gray-600 text-sm md:text-base font-light mt-3">Living enzymes in fresh food  faciltiate digestion and help your dog grow a more diverse range of healthy gut bacteria. This makes it easy for your dog to properly absorb the nutrients it needs from their food. If food is able to pass through the gut lining into the bloodstream without being properly broken down, this condition is called leaky gut. Many of the most common health issues we see today in dogs, like itchy skin, stem from poor gut health.
</p></div>
        <div x-show="keyBenefit === 4" class="flex flex-col items-center text-center justify-center mt-8 lg:mt-0" style="display: none;"><h4 class="text-2xl md:text-3xl lg:text-3xl font-display leading-none">Oral health</h4><p class="text-gray-600 text-sm md:text-base font-light mt-3">Stinky breath comes from poor oral and gut health. Starches in dry food cause plaque and tartar to build up on teeth. This usually will result in a trip to the Vet and your dog undergoing a general anaesthetic to have his teeth cleaned. Bacterial endocarditis, an infection affecting the lining of the heart, is commonly seen in dogs with dental disease.</p></div>

        <div x-show="keyBenefit === 5" class="flex flex-col items-center text-center justify-center mt-8 lg:mt-0" style="display: none;"><h4 class="text-2xl md:text-3xl lg:text-3xl font-display leading-none">Shiny Coat</h4><p class="text-gray-600 text-sm md:text-base font-light mt-3">When they’re healthy on the inside they’re literally shining on the outside. Up to 40% of the protein your dog eats goes into growing it’s coat. Dog parents often comment on how much softer and shinier their dog's coat feels on a raw diet.</p></div>

        <div x-show="keyBenefit === 6" class="flex flex-col items-center text-center justify-center mt-8 lg:mt-0" style="display: none;"><h4 class="text-2xl md:text-3xl lg:text-3xl font-display leading-none">Smaller poop and better hydration</h4><p class="text-gray-600 text-sm md:text-base font-light mt-3">Fresh food has a high moisture content so your dog will naturally be hydrated, and not in a state of constant dehydration, as with dry food. The result is they need to drink a lot less water, so they wee less. Without all the indigestible bulking ingredients found in dry food  there is a lot less waste matter to pick up at the park.</p></div>

 

        <div x-show="keyBenefit === 8" class="flex flex-col items-center text-center justify-center mt-8 lg:mt-0" style="display: none;"><h4 class="text-2xl md:text-3xl lg:text-3xl font-display leading-none">Farting</h4><p class="text-gray-600 text-sm md:text-base font-light mt-3">Does your best friend clear the room with a silently deadly? Feeding processed food leads to poor gut health and flatulence is a sign.  Feeding fresh food helps to eliminate these problems.</p></div>


        <div x-show="keyBenefit === 7" class="flex flex-col items-center text-center justify-center mt-8 lg:mt-0" style="display: none;"><h4 class="text-2xl md:text-3xl lg:text-3xl font-display leading-none">Strengthened immune system</h4><p class="text-gray-600 text-sm md:text-base font-light mt-3">Over 80% of the immune system resides in the gut - so a healthy gut results in a healthier dog.</p></div>

  </div></div><div class="order-1 lg:order-2 w-3/4 mx-auto lg:w-1/2 xl:w-1/2 lg:px-10 pl-0 xl:pl-16 text-gray-900">




    <div class="w-full relative">
      <div @click="keyBenefit = 1" class="hotspot" style="top:62%;left:40%"><div :class="{ &#39;bg-butchers-red-800 border-2 border-gray-400 w-5 h-5 shadow-md&#39;: keyBenefit === 1 }" class="hotspot__inner bg-butchers-red-800 border-2 border-gray-400 w-5 h-5 shadow-md"></div></div>
      <div @click="keyBenefit = 2" class="hotspot" style="top:6%;left:20%"><div :class="{ &#39;bg-butchers-red-800 border-2 border-gray-400 w-5 h-5 shadow-md&#39;: keyBenefit === 2 }" class="hotspot__inner"></div></div>
      <div @click="keyBenefit = 3" class="hotspot" style="top:57%;left:54%"><div :class="{ &#39;bg-butchers-red-800 border-2 border-gray-400 w-5 h-5 shadow-md&#39;: keyBenefit === 3 }" class="hotspot__inner"></div></div>
      <div @click="keyBenefit = 4" class="hotspot" style="top:20%;left:-5%"><div :class="{ &#39;bg-butchers-red-800 border-2 border-gray-400 w-5 h-5 shadow-md&#39;: keyBenefit === 4 }" class="hotspot__inner"></div></div>
      <div @click="keyBenefit = 5" class="hotspot" style="top:21%;left:45%"><div :class="{ &#39;bg-butchers-red-800 border-2 border-gray-400 w-5 h-5 shadow-md&#39;: keyBenefit === 5 }" class="hotspot__inner"></div></div>

      <div @click="keyBenefit = 6" class="hotspot" style="top:44%;left:82%"><div :class="{ &#39;bg-butchers-red-800 border-2 border-gray-400 w-5 h-5 shadow-md&#39;: keyBenefit === 6 }" class="hotspot__inner"></div></div>

      <div @click="keyBenefit = 8" class="hotspot" style="top:35%;left:100%"><div :class="{ &#39;bg-butchers-red-800 border-2 border-gray-400 w-5 h-5 shadow-md&#39;: keyBenefit === 8 }" class="hotspot__inner"></div></div>

      <div @click="keyBenefit = 7" class="hotspot" style="top:40%;left:8%"><div :class="{ &#39;bg-butchers-red-800 border-2 border-gray-400 w-5 h-5 shadow-md&#39;: keyBenefit === 7 }" class="hotspot__inner"></div></div>

      <img class="w-full mobail-dog-slid" src="<?php echo get_site_url();?>/wp-content/uploads/2020/10/Dog.png" alt="Key Benefits of Going Raw"></div></div></div></div></div>








</div>


    
</div>
</body>