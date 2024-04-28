<div x-data="{ count: 0 }">
    <h2 x-text="count"></h2>
 
    <button x-on:click="count--">-</button>
    <button x-on:click="count++">+</button>
</div>