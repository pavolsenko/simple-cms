<div class="text-center">
    <nav>
        <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>


            @for($ii = 1; $ii <= $total_pages; $ii++)
                @if($ii == $current_page)

            <li class="active"><a href="?page={{ $ii }}">{{ $ii }}</a></li>

                @else

            <li><a href="?page={{ $ii }}">{{ $ii }}</a></li>

                @endif
            @endfor

            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>