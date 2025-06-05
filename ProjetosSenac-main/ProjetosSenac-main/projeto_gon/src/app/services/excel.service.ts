import { Injectable } from '@angular/core';
import * as FileSaver from 'file-saver';
import * as XLSX from 'xlsx';

const EXCEL_TYPE = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8';
const EXCEL_EXTENSION = '.xlsx';

@Injectable()

export class ExcelService {

    constructor() { }

    public excelFileName: string = 'SilabSST'

    public exportAsExcelFile(json: any[], table: string): void {

        const worksheet: XLSX.WorkSheet = XLSX.utils.json_to_sheet(json);
        // console.log('worksheet', worksheet);
        const workbook: XLSX.WorkBook = { Sheets: { 'data' : worksheet }, SheetNames: ['data'] };
        const excelBuffer: any = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });
        //const excelBuffer: any = XLSX.write(workbook, { bookType: 'xlsx', type: 'buffer' });
        this.saveAsExcelFile(excelBuffer, this.excelFileName, table);
    }

    private saveAsExcelFile(buffer: any, fileName: string, table: string): void {
        const data: Blob = new Blob([buffer], {
            type: EXCEL_TYPE
        });
        FileSaver.saveAs(data, fileName + '_' + table + '_' + new Date().getTime() + EXCEL_EXTENSION);
    }

}