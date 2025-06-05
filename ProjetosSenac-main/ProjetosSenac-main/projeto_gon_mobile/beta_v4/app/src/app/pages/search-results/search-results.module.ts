import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { SearchResultsPageRoutingModule } from './search-results-routing.module';
import { HeaderSearchComponent } from 'src/app/component/header/search/header-search.component';

import { SearchResultsPage } from './search-results.page';
import { RouterModule } from '@angular/router';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    SearchResultsPageRoutingModule,
    RouterModule.forChild([{ path: '', component: SearchResultsPage }])
  ],
  declarations: [SearchResultsPage, HeaderSearchComponent]
})
export class SearchResultsPageModule {}
