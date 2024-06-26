@include("layouts.header")

<style>

    table, th, td {
        border: 1px solid white;
        border-collapse: collapse;
        padding: 5px 10px;
        margin: 0 auto;
    }
</style>
<h1>{{ $details->title }}</h1>
<p>{{ $details->description }}</p>
<p>Od: <?php echo date('d.m.Y', strtotime($details->start)); ?> <br>
    Do: <?php echo date('d.m.Y', strtotime($details->end)); ?></p>

@if( empty($already) )
    <form action="/ucast" method="post">
        @csrf
        <input type="submit" value="Zúčastnit se">
        <input type="hidden" name="schedule_id" value="{{ $details->id }}">
        <input type="hidden" name="user_id" value="{{ $userId }}">
        <input type="hidden" name="ucast" value="1">
    </form>
    <form action="/ucast" method="post">
        @csrf
        <input type="submit" value="Nezúčastnit se">
        <input type="hidden" name="schedule_id" value="{{ $details->id }}">
        <input type="hidden" name="user_id" value="{{ $userId }}">
        <input type="hidden" name="ucast" value="0">
    </form>
@else
        <?php if ($ucastnik == "neni") {
    }else{ ?>
        <?php if (!empty($ucastnik) && $ucastnik->ucast == 0){ ?>
    <p style="color:#FF0000FF">Succesfuly non-attendance</p>
    <form action="/ucast_update" method="post">
        @csrf
        <input type="submit" value="Zúčastnit se">
        <input type="hidden" name="schedule_id" value="{{ $details->id }}">
        <input type="hidden" name="user_id" value="{{ $userId }}">
        <input type="hidden" name="ucast" value="1">
    </form>
    <?php } else if (!empty($ucastnik) && $ucastnik->ucast == 1){ ?>
    <p style="color:#00ff00">Succesfuly attendance</p>
    <form action="/ucast_update" method="post">
        @csrf
        <input type="submit" value="Nezúčastnit se">
        <input type="hidden" name="schedule_id" value="{{ $details->id }}">
        <input type="hidden" name="user_id" value="{{ $userId }}">
        <input type="hidden" name="ucast" value="0">
    </form>

    <?php }
    } ?>

@endif



<h2>Učástnící</h2>

<table>
    <tr>
        <th>Jméno</th>
        <th>Účast</th>
    </tr>

    @empty(!$ucast)
            <?php $i = 0 ?>
        @foreach($ucast as $u)
            <tr>
                <td>{{ $u[0]->name }}</td>
                <td><?php if ($ucastni[$i]->ucast == 1) {
                        echo "<span style='color:#00ff00'>✓</span>";
                    } else {
                        echo "<span style='color:#FF0000FF'>✗</span>";
                    } ?></td>
            </tr>
                <?php $i++ ?>
        @endforeach

    @else
        <tr>
            <td colspan="2">Bez účastníků</td>

        </tr>
    @endif
</table>

@include("layouts.footer")
