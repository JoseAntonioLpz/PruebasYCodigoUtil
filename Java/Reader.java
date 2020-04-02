package com.ms2s.middleware.service.util;

import java.io.File;
import java.io.FileNotFoundException;
import java.util.Scanner;

public class Reader {
	
	private String filename;
	
	public Reader(String filename) {
		this.filename = filename;
	}
	
	public String getContent() {
		String content = null;
		try {
			File file = new File(this.filename);
			Scanner sc = new Scanner(file);
			while (sc.hasNextLine()) {
		        content += sc.nextLine();
		      }
			sc.close();
		}catch (FileNotFoundException e) {
			System.out.println("El archivo " + this.filename + " no se ha encontrado");
	    }catch(Exception e) {
	    	e.printStackTrace();
		}
		return content;
	}
	
	public static String getContent(String filename) {
		return new Reader(filename).getContent();
	}
}
