function HandleChangeStatus(id, isCompleted) {
    window.location.href = `${window.location.origin}/Todophp/Services/updateStatusServices.php?id=${id}&isCompleted=${isCompleted}`;
}