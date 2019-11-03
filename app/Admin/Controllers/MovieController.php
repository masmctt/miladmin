<?php

namespace App\Admin\Controllers;

use App\User;
use App\Movie;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Controllers\AdminController;

class MovieController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Peliculas';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Movie);

        // La primera columna muestra el campo de identificación y establece la columna como una columna ordenable
        $grid->id('ID')->sortable();

        // The second column shows the title field, because the title field name and the Grid object's title method conflict, so use Grid's column () method instead
        // La segunda columna muestra el campo de título, porque el nombre del campo de título y el método de título del objeto Grid entran en conflicto, por lo tanto, use el método column () de Grid
        $grid->column('title');

        // The third column shows the director field, which is set by the display($callback) method to display the corresponding user name in the users table
        // La tercera columna muestra el campo del director, que se establece mediante el método de visualización ($ callback) para mostrar el nombre de usuario correspondiente en la tabla de usuarios
        $grid->director()->display(function($userId) {
            return User::find($userId)->name;
        });

        // The fourth column appears as the describe field
        // La cuarta columna aparece como el campo de descripción.
        $grid->describe();

        // The fifth column is displayed as the rate field
        // La quinta columna se muestra como el campo de tasa
        $grid->rate();

        // The sixth column shows the released field, formatting the display output through the display($callback) method
        // La sexta columna muestra el campo liberado, formateando la salida de la pantalla a través del método de visualización ($ callback)
        $grid->released('Release?')->display(function ($released) {
            return $released ? 'yes' : 'no';
        });

        // The following shows the columns for the three time fields
        // A continuación se muestran las columnas para los tres campos de tiempo.
        $grid->release_at();
        $grid->created_at();
        $grid->updated_at();

        // The filter($callback) method is used to set up a simple search box for the table
        // El método de filtro ($ callback) se usa para configurar un cuadro de búsqueda simple para la tabla
        $grid->filter(function ($filter) {

            // Sets the range query for the created_at field
            // Establece la consulta de rango para el campo created_at
            $filter->between('created_at', 'Created Time')->datetime();
        });

        //Modificar los datos de origen

        // $grid->model()->where('id', '>', 100);
        // $grid->model()->orderBy('id', 'desc');
        // $grid->model()->take(100);

        // The default is 20 per page

        //$grid->paginate(15);

        // column not in table

        // $grid->column('full_name')->display(function () {
        //     return $this->first_name.' '.$this->last_name;
        // });

        // Deshabilita el botón Crear
        // $grid->disableCreateButton();
        //  Deshabilitar paginación
        // $grid->disablePagination();
        // Deshabilitar filtro de datos
        // $grid->disableFilter();
        // Deshabilitar el botón exportar
        // $grid->disableExport();
        // Deshabilitar selector de fila
        // $grid->disableRowSelector();
        // Deshabilitar acciones de fila
        // $grid->disableActions();
        // Deshabilitar selector de columna
        // $grid->disableColumnSelector();
        // Establecer opciones para el selector por página
        // $grid->perPages([10, 20, 30, 40, 50]);


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Movie::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Movie);

        $form->display('id', __('ID'));
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        return $form;
    }
}
