<template>
    <!-- Footer -->
    <div class="containerrr" style="background-color: grey">
        <mdb-footer color="blue" class="font-small pt-4 mt-4">
            <div class="text-left">
                <div class="row">
                    <mdb-col sm="6" style="margin-left: 40%">
                        <h5 class="title">Footer Content</h5>
                        <p>
                            Here you can use rows and columns here to organize
                            your footer content.
                        </p>
                    </mdb-col>
                    <mdb-col sm="6" style="margin-left: 40%">
                        <h5 class="title">Links</h5>
                        <ul>
                            <li class="list-unstyled">
                                <a href="#!" style="color: white">Link 1</a>
                            </li>
                            <li class="list-unstyled">
                                <a href="#!" style="color: white">Link 2</a>
                            </li>
                            <li class="list-unstyled">
                                <a href="#!" style="color: white">Link 3</a>
                            </li>
                            <li class="list-unstyled">
                                <a href="#!" style="color: white">Link 4</a>
                            </li>
                        </ul>
                    </mdb-col>
                </div>
            </div>
            <div class="footer-copyright text-center py-3">
                <mdb-container fluid>
                    &copy; 2020 Copyright:
                    <a href="#" style="color: white"> Rufat Abdullayev </a>
                </mdb-container>
            </div>
        </mdb-footer>
    </div>
    <!-- Footer -->
</template>

<script>
import axios from "axios";
export default {
    name: "footer",
    data() {},
};
</script>
