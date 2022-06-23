<script>
    export let obj;
    export let dateNow;

    let startDate = obj.startTime;
    let endDate = obj.endTime;

    let calc = 0;

    async function reserve() {
        let form = new FormData();
        form.set("id", obj.id);
        form.set("startDate", startDate);
        form.set("endDate", endDate);

        let res = await fetch("./backend/ReserveCar.php", {
            method: "POST",
            body: form,
        });

        let json = await res.json();

        //   window.location.reload();
        window.location.reload();
    }

    async function del() {
        let form = new FormData();
        form.set("id", obj.id);
        let res = await fetch("./backend/DeleteCar.php", {
            method: "POST",
            body: form,
        });

        let json = await res.json();

        console.log(json);
        window.location.reload();
    }
    function dateHandler() {
        console.log(startDate);

        if (startDate != "" && endDate != "") {
            let parseStart = new Date(startDate).getTime();
            let parseEnd = new Date(endDate).getTime();
            calc = ((parseEnd - parseStart) / (3600 * 24 * 1000)) * obj.cena;
        }
    }
</script>

<div class="p-4 md:w-1/3 sm:mb-0 mb-6">
    <div class="rounded-lg h-64 overflow-hidden">
        <img
            alt="content"
            class="object-cover object-center h-full w-full"
            src={obj.zdjecie}
        />
    </div>
    <h2 class="text-xl font-medium title-font text-gray-900 mt-5">
        {obj.marka}
        {obj.model}
    </h2>
    <p class="text-base leading-relaxed mt-2 w-max">
        kolor:
        {obj.kolor}
        <br />
        silnik:
        {obj.silnik}
        konii mechanicznych<br />
        przyspieszenie:
        {obj.przyspieszenie}
        s<br />
        cena:
        {obj.cena}
        zł<br />

        oczekujący:
        {obj.count}
        <br />
    </p>
    <br />
    <p>Podaj datę początkową</p>
    <input
        type="date"
        bind:value={startDate}
        id=""
        min={new Date(dateNow).toJSON().slice(0, 10)}
        max={endDate == ""
            ? ""
            : new Date(new Date(endDate).getTime() - 3600 * 24 * 1000)
                  .toJSON()
                  .slice(0, 10)}
        disabled={obj.reserved}
        on:input={dateHandler}
    />

    <br />
    <p>Podaj datę końcową</p>
    <!-- min={minEndDate} -->
    <input
        type="date"
        bind:value={endDate}
        id=""
        min={new Date(
            (startDate == "" ? dateNow : new Date(startDate).getTime()) +
                3600 * 24 * 1000
        )
            .toJSON()
            .slice(0, 10)}
        disabled={obj.reserved || obj.id_status}
        on:input={dateHandler}
    />
    <br />
    <p>koszt: {calc} zł</p>

    {#if dateNow - new Date(endDate).getTime() > 0}
        <p class="text-red-600">Przetrzymujesz auto</p>
    {/if}

    {#if !obj.reserved}
        <button
            class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
            on:click={reserve}
        >
            Zarezerwuj</button
        >

        {#if obj.myWaiting}
            <button
                class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg"
                on:click={del}
            >
                Usun</button
            >
        {/if}
    {:else if obj.myWaiting}
        <button
            class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg"
            on:click={del}
        >
            Oddaj
        </button>
        <br />

        <a href={obj.qrCode}>QrCode</a>
    {:else}
        <p>Niedostępne</p>
    {/if}
</div>

<!-- on:input={() => {
   console.log(startDate);
}} -->
<style>
    input {
        color: grey;
    }

    a {
        color: rgb(54, 54, 220);
    }
</style>
