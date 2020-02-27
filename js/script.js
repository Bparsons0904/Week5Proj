function categorySelect() {
  document.getElementById("cat-change").submit();
}

function deleteItem(itemNum, categoryID) {
    document.getElementById("itemValue").value = itemNum;
    document.getElementById("categoryValue").value = categoryID;
    document.getElementById("delete-item-form").submit();
}

function deleteCategory(categoryID) {
    document.getElementById("delete-category-value").value = categoryID;
    document.getElementById("delete-category-form").submit();
}

window.onload = ()=> {
    const value = document.getElementById("navInput");
    const toDoList = document.getElementById("toDoList");
    const navControl = document.getElementById("navControl");
    toDoList.addEventListener("click", ()=> {
        value.value = "list-items";
        navControl.submit();
    })
    const addToDo = document.getElementById("addToDo");
    addToDo.addEventListener("click", ()=> {
        value.value = "additem";
        navControl.submit();
    })
    const categoryList = document.getElementById("categoryList");
    categoryList.addEventListener("click", ()=> {
        value.value = "list_categories";
        navControl.submit();
    })
}