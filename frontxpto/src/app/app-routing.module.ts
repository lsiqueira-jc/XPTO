import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Routes } from '@angular/router';
import { ListaComponent } from './lista/lista.component';
import { AgendaFormComponent } from './agenda-form/agenda-form.component';



const routes: Routes = [

  { path: '', redirectTo: '/', pathMatch: 'full' },
  { path: 'agenda', component: ListaComponent },
  { path: 'agenda/form', component: AgendaFormComponent},
  { path: 'agenda/form/:id', component: AgendaFormComponent},
];


@NgModule({
  imports: [
    CommonModule,
    RouterModule.forRoot(routes),

  ],
  exports: [ RouterModule ],
  declarations: []
})
export class AppRoutingModule { }
