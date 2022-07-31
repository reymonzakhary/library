<div class="cardBox">
    <div class="card">
        <div>
            <div class="numbers">
                @if (count($books) > 0)
                    {{ count($books) }}
                @else
                    0
                @endif

            </div>
            <div class="cardName">
                Books
            </div>
        </div>
        <div class="iconCard">
            <ion-icon name="book-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers">

            </div>
            <div class="cardName">
                Categories
            </div>
        </div>
        <div class="iconCard">
            <ion-icon name="people-circle-outline"></ion-icon>
        </div>
    </div>
    <div class="card">
        <div>
            <div class="numbers">
                120
            </div>
            <div class="cardName">
                Users
            </div>
        </div>
        <div class="iconCard">
            <ion-icon name="person-outline"></ion-icon>
        </div>
    </div>
</div>
