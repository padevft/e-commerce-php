// var $paginationM,
//     totalRecordsM = 0,
//     recordsM = [],
//     displayRecordsM = [],
//     recPerPageM = 7,
//     page = 1,
//     totalPagesM = 0;

// function paginationM(Mories) {
//     if (Mories.length > 0) {
//         displayRecordsM = [];
//         $paginationM = $("#pagination-membres");
//         recordsM = Mories;
//         totalRecordsM = recordsM.length;
//         totalPagesM = Math.ceil(totalRecordsM / recPerPageM);
//         applyPaginationMembre();
//     } else {
//         $(".admin-list-Ms").html(
//             `<tr><td colspan="3"><div class="d-flex justify-content-center align-items-center justify-content-center"><h1>Aucune Membre</h1></div></td></tr>`
//         );
//     }
// }

// function generateMembre() {
//     let rep = "";
//     for (let M of displayRecordsM) {
//         rep += construireMembre(M);
//     }
//     $(".admin-list-membres").html(rep);
//     // MAction();
// }

// function applyPaginationMembre() {
//     $paginationM.twbsPagination("destroy");
//     $paginationM.twbsPagination({
//         totalPages: totalPagesM,
//         visiblePages: 3,
//         onPageClick: function (event, page) {
//             var displayRecordsIndex = Math.max(page - 1, 0) * recPerPageM;
//             var endRec = displayRecordsIndex + recPerPageM;
//             displayRecordsM = recordsM.slice(displayRecordsIndex, endRec);
//             generateMembre();
//         },
//     });
// }