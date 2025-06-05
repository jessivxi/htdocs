import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { NbToastrService } from '@nebular/theme';
import { map, retry, catchError, timeout } from 'rxjs/operators';

@Injectable()
export class ApiService {
  server: string = 'http://localhost/api/';
  private token = '1';
  constructor(private http: HttpClient, private toastr: NbToastrService) { }

  getAPI(api: string) {
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-type': 'application/json',
        Authorization: `Bearer ${this.token}`,
      }),
    };

    const url = this.server + api;

    return this.http.get(url, httpOptions).pipe(
      map((res: any) => res),
      retry(3),
      timeout(5000),
      catchError((err: any): any => {
        if (err.name === 'TimeoutError') {
          this.showToast(
            'Ops!',
            'No momento o servidor de dados está com lentidão',
            'danger'
          );
        } else {
          this.showToast(
            'Ops!',
            'Estamos sem comunicação com o servidor de dados',
            'danger'
          );
        }
      })
    );
  }

  postAPI(dados: any, api: string) {
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-type': 'application/json',
        Authorization: `Bearer ${this.token}`,
      }),
      body: dados,
    };

    const url = this.server + api;

    return this.http.post(url, httpOptions).pipe(
      map((res: any) => res),
      retry(3),
      timeout(5000),
      catchError((err: any): any => {
        if (err.name === 'TimeoutError') {
          this.showToast(
            'Ops!',
            'No momento o servidor de dados está com lentidão',
            'danger'
          );
        } else {
          this.showToast(
            'Ops!',
            'Estamos sem comunicação com o servidor de dados',
            'danger'
          );
        }
      })
    );
  }

  putAPI(dados: any, api: string) {
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-type': 'application/json',
        Authorization: `Bearer ${this.token}`,
      }),
      body: dados,
    };

    const url = this.server + api;

    return this.http.put(url, httpOptions).pipe(
      map((res: any) => res),
      retry(3),
      timeout(5000),
      catchError((err: any): any => {
        if (err.name === 'TimeoutError') {
          this.showToast(
            'Ops!',
            'No momento o servidor de dados está com lentidão',
            'danger'
          );
        } else {
          this.showToast(
            'Ops!',
            'Estamos sem comunicação com o servidor de dados',
            'danger'
          );
        }
      })
    );
  }

  deleteAPI(dados: any, api: any) {

    const httpOptions = {
      headers: new HttpHeaders({
        'Content-type': 'application/json',
        // Authorization: `Bearer ${token}`,
      }),
      body: dados,
    };

    const url = this.server + api;

    return this.http.delete(url, httpOptions).pipe(
      map((res: any) => res),
      retry(3),
      timeout(5000),
      catchError((err: any): any => {
        if (err.name === 'TimeoutError') {
          this.showToast(
            'Ops!',
            'No momento o servidor de dados está com lentidão',
            'danger'
          );
        } else {
          this.showToast(
            'Ops!',
            'Estamos sem comunicação com o servidor de dados',
            'danger'
          );
        }
      })
    );
  }

  pesquisaCNPJ(cnpj: string) {
    const url = 'https://api.cnpja.com/office/' + cnpj;
    const token =
      'a39a1d85-8efb-4e7b-8635-59f90b16ebb5-f1e6194d-d22d-4c1f-89ac-9e9e1e5c99db';
    const httpOptions = {
      headers: new HttpHeaders({ Authorization: token }),
    };

    return this.http.get(url, httpOptions).pipe(map((res: any) => res));
  }

  pesquisaCEP(cep: string) {
    if (cep == 'error') {
      this.showToast('Ops!', 'Estamos sem conexão com o servidor', 'danger');
    }
    return this.http.get('https://viacep.com.br/ws/' + cep + '/json/');
  }

  showToast(title: string, message: string, status: any) {
    this.toastr.show(message, title, { status });
  }
}
