@include("layouts.header")

    <h1>Rezervace</h1>
    <form style="display: flex;flex-direction: column; gap: 10px; width: 25%;margin: 0 auto">
        @csrf
        <input type="text">
        <input type="text">
        <input type="submit">
    </form>
@include("layouts.footer")
