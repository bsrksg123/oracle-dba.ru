<?php
// Include the GeSHi library//
include_once 'geshi.php'; 
//// Define some source to highlight, a language to use
// and the path to the language files//
 $source = '
package ru.javadev;

import java.io.IOException;
import java.io.PrintWriter;

import javax.ejb.EJB;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import ru.javadev.model.FacadeLocal;

@WebServlet("/Servlet1")
public class Servlet1 extends HttpServlet {
	private static final long serialVersionUID = 1L;

	@EJB
	private FacadeLocal f;

	public Servlet1() {
		super();

	}

	protected void service(HttpServletRequest request,
			HttpServletResponse response) throws ServletException, IOException {

		response.setContentType("text/html;charset=UTF-8");
		PrintWriter out = response.getWriter();

		out.print("<html>");
		out.print("<hr/>");

		out.print("<br/>");
		out.print("Результат выполнения метода: " + f.info());

		out.print("<hr/>");
		out.print("</html>");

		out.close();

	}

}';$language = 'java';


// Create a GeSHi object//
$geshi = new GeSHi($source, $language);

$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS); 


$geshi->set_line_style('color: black; background: #fcfcfc;', 'color: green; background: #f0f0f0;');


// Disabling all URLs for Keywords
$geshi->enable_keyword_links(false);

// And echo the result!//
echo $geshi->parse_code();

?>
