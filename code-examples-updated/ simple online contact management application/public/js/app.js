var grid = $("#grid-data").bootgrid({
    ajax: true,
    url: "/contacts",
    formatters: {
        "commands": function(column, row)
        {
            return  "<button type=\"button\" class=\"btn btn-xs btn-default command-view\" data-row-id=\"" + row.id + "\">View<span class=\"fa\"></span></button>" +
                "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\">Edit<span class=\"fa\"></span></button> " +
                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\">Delete<span class=\"fa\"></span></button>";
        }
    }
}).on("loaded.rs.jquery.bootgrid", function()
{
    /* Executes after data is loaded and rendered */
    grid.find(".command-edit").on("click", function(e)
    {
        window.location = "/contacts/"+$(this).data("row-id")+"/edit/";
    }).end().find(".command-delete").on("click", function(e)
    {
        window.location = "/contacts/"+$(this).data("row-id")+"/delete/";
    }).end().find(".command-view").on("click", function(e)
    {
        window.location = "/contacts/"+$(this).data("row-id")+"/";
    });
});