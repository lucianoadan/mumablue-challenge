import { Component, Input, OnInit } from '@angular/core';

@Component({
    selector: 'app-pagination',
    template: `
    <nav aria-label="pagination example">
    <ul class="pagination pagination-circle pg-blue mb-0">

        <!--First-->
        <li class="page-item disabled"><a class="page-link">First</a></li>

        <!--Arrow left-->
        <li class="page-item disabled">
            <a class="page-link" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>

        <!--Numbers-->
        <li class="page-item active"><a class="page-link">1</a></li>
        <li class="page-item"><a class="page-link">2</a></li>
        <li class="page-item"><a class="page-link">3</a></li>
        <li class="page-item"><a class="page-link">4</a></li>
        <li class="page-item"><a class="page-link">5</a></li>

        <!--Arrow right-->
        <li class="page-item">
            <a class="page-link" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>

        <!--Last-->
        <li class="page-item"><a class="page-link">Last</a></li>

    </ul>
</nav>
    `
})
export class PaginationComponent {
   
    public constructor(){
        
    }
   
}