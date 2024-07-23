//
//  BadgeBackground.swift
//  lpz
//
//  Created by Jose Antonio Lopez Lopez on 3/7/23.
//

import SwiftUI

struct BadgeBackground: View {
    var body: some View {
        GeometryReader { geometry in
            Path { path in
                var width: CGFloat = min(geometry.size.width, geometry.size.height)
                let height = width
                let xScale: CGFloat = 0.832
                let xOffset = (width * (1.0 - xScale)) / 2.0
                
                width *= xScale
                path.move(
                    to: CGPoint(
                        x: width * 0.95 + xOffset,
                        y: height * (0.20 + HexagonParameters.adjustment)
                    )
                )
                
                HexagonParameters.segments.forEach { segments in
                    path.addLine(
                        to: CGPoint(
                            x: width * segments.line.x + xOffset,
                            y: height * segments.line.y
                        )
                    )
                    
                    path.addQuadCurve(
                        to: CGPoint(
                            x: width * segments.curve.x + xOffset,
                            y: height * segments.curve.y
                        ),
                        control: CGPoint(
                            x: width * segments.control.x + xOffset,
                            y: height * segments.control.y
                        )
                    )
                }
            }
            .fill(
                .linearGradient(
                    Gradient(colors: [Self.gradientStart,Self.gradientEnd]),
                    startPoint: UnitPoint(x: 0.5, y: 0),
                    endPoint: UnitPoint(x: 0.5, y: 0.6)
                )
            )
        }
        .aspectRatio(1, contentMode: .fit)
    }
    
    static let gradientStart = Color(red: 239.0 / 255, green: 120.0 / 255, blue: 221.0 / 255)
    static let gradientEnd = Color(red: 239.0 / 255, green: 172.0 / 255, blue: 120.0 / 255)
}

struct BadgeBackground_Previews: PreviewProvider {
    static var previews: some View {
        BadgeBackground()
    }
}
